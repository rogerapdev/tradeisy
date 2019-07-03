<?php

namespace App\Events;

use App\Models\Broker;
use App\Models\Order;
use App\Models\Stock;
use Exception;

class OrderEvent
{

    /**
     * @param App\Models\Order
     */
    public function creating($order)
    {

        $broker = Broker::findOrFail($order->broker_id);

        $quantity = unFormatDecimal($order->quantity);
        $order->cost = $quantity * unFormatMoney($order->unit_price);
        $order->rate = percentage($broker->emolument_normal, $order->cost);
        $order->expense = $broker->brokerage + $order->rate;

        if ($order->type == 'C') {

            $order->equilibrium_price = ceiling(($order->cost + $order->expense) / $quantity, 0.01);

            $available = floatval($broker->available);
            $new = $broker->available - $order->cost;

            if ((round($available, 2) == round(0, 2))) {
                throw new Exception('Você não possui saldo disponível para a corretora informada.', 1);
            } elseif (round($available, 2) < round($order->cost, 2)) {
                throw new Exception('Saldo disponível na corretora é insuficiente.', 1);
            } elseif (round($new, 2) < round(0, 2)) {
                throw new Exception('Saldo disponível na corretora é insuficiente.', 1);
            }
        } elseif ($order->type == 'V') {

            $order->equilibrium_price = 0;

            $stock = Stock::where('broker_id', $order->broker_id)
                ->where('stock_ticker', $order->stock_ticker)
                ->orderBy('created_at', 'desc')->first();

            if (!$stock) {
                throw new Exception('Não foi possível encontrar o ativo para efetuar a venda.', 1);
            }

        } else {
            throw new Exception('Não foi possivel identificar o tipo da ordem.', 1);

        }

        // return true;
    }

    /**
     * @param App\Models\Order
     */
    public function created($order)
    {

        $broker = Broker::findOrFail($order->broker_id);

        if ($order->type == 'C') {
            $broker->available = (floatval($broker->available) - $order->cost);
        } elseif ($order->type == 'V') {
            $broker->available = (floatval($broker->available) + ($order->cost - $order->expense));
        }

        $broker->save();

        if ($order->type == 'C') {
            $this->buyOrder($order);
        } elseif ($order->type == 'V') {
            $this->sellOrder($order);
        }

        return true;
    }

    /**
     * @param $events
     */
    public function subscribe($events)
    {
        $events->listen('eloquent.creating: ' . Order::class, 'App\Events\OrderEvent@creating');
        $events->listen('eloquent.created: ' . Order::class, 'App\Events\OrderEvent@created');

    }

    private function buyOrder($order)
    {

        $broker = Broker::findOrFail($order->broker_id);

        $stock = Stock::where('broker_id', $order->broker_id)
            ->where('stock_ticker', $order->stock_ticker)
            ->orderBy('created_at', 'desc')->first();

        if (!$stock) {

            $data = [
                'broker_id' => $order->broker_id,
                'stock_ticker' => $order->stock_ticker,
                'quantity' => $order->quantity,
                'average_price' => $order->unit_price,
                'invested' => $order->cost,
                'stop_loss' => $order->unit_price - percentage($broker->percentage_stop_loss, $order->unit_price),
                'stop_gain' => $order->unit_price + percentage($broker->percentage_stop_gain, $order->unit_price),
                'rate' => $order->rate,
                'expense' => $order->expense,
                'equilibrium_price' => $order->equilibrium_price,

            ];

            Stock::create($data);

        } else {

            $quantity = $stock->quantity + $order->quantity;
            $invested = $stock->invested + $order->cost;
            $average_price = ceiling($invested / $quantity, 0.01);
            $stop_loss = $average_price - percentage($broker->percentage_stop_loss, $average_price);
            $stop_gain = $average_price + percentage($broker->percentage_stop_gain, $average_price);
            $rate = percentage($broker->emolument_normal, $invested);
            $expense = $broker->brokerage + $rate;
            $equilibrium_price = ceiling(($invested + $expense) / $quantity, 0.01);

            $data = [
                'quantity' => $quantity,
                'average_price' => $average_price,
                'invested' => $invested,
                'stop_loss' => $stop_loss,
                'stop_gain' => $stop_gain,
                'rate' => $rate,
                'expense' => $expense,
                'equilibrium_price' => $equilibrium_price,
            ];

            $stock->update($data);
        }

    }

    private function sellOrder($order)
    {

        $stock = Stock::where('broker_id', $order->broker_id)
            ->where('stock_ticker', $order->stock_ticker)
            ->orderBy('created_at', 'desc')->first();

        if (!$stock) {
            throw new Exception('Não foi possível encontrar o ativo para efetuar a venda.', 1);
        }

        $broker = Broker::findOrFail($order->broker_id);

        $quantity = $stock->quantity - $order->quantity;

        if (round($quantity, 2) > round(0, 2)) {

            $invested = $stock->average_price - $quantity;
            $rate = percentage($broker->emolument_normal, $invested);
            $expense = $broker->brokerage + $rate;
            $equilibrium_price = ceiling(($invested + $expense) / $quantity, 0.01);

            $data = [
                'quantity' => $quantity,
                'average_price' => $average_price,
                'invested' => $invested,
                'stop_loss' => $stop_loss,
                'stop_gain' => $stop_gain,
                'rate' => $rate,
                'expense' => $expense,
                'equilibrium_price' => $equilibrium_price,
            ];

            $stock->update($data);

        } else {

            $stock->delete();
        }

    }

}
