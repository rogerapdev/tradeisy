<?php

return [

    'permission' => [
        'not_found' => 'Desculpa! A permissão solicitada não foi encontrada!',
        'saved' => 'Parabéns! Permissão [:permissionId] salva com êxito!',
        'deleted' => 'Feito! Permissão [:permissionId] excluída com êxito!',
    ],

    'role' => [
        'not_found' => 'Desculpa! O grupo solicitado não foi encontrado!',
        'saved' => 'Parabéns! Grupo [:roleId] salvo com êxito!',
        'deleted' => 'Feito! Grupo [:roleId] excluído com êxito!',
        'saved_permissions' => 'Feito! Permissões do grupo [:roleId] salvas com êxito!',
    ],

    'resource' => [
        'not_found' => 'Desculpa! O recurso solicitado não foi encontrado!',
        'saved' => 'Parabéns! Recurso [:resourceId] salvo com êxito!',
        'deleted' => 'Feito! Recurso [:resourceId] excluído com êxito!',
    ],

    'user' => [
        'not_found' => 'Desculpa! O usuário solicitado não foi encontrado!',
        'saved' => 'Parabéns! Usuário [:userId] salvo com êxito!',
        'deleted' => 'Feito! Usuário [:userId] excluído com êxito!',
        'saved_permissions' => 'Feito! Permissões do usuário [:userId] salvas com êxito!',
        'saved_roles' => 'Feito! Grupos do usuário [:userId] salvos com êxito!',
        'saved_profile' => 'Feito! Perfil do usuário [:userId] salvo com êxito!',
        'change_password' => 'Feito! Senha alterada com sucesso. Efetue o login novamente!',
    ],

    'auth' => [
        'authorize' => 'O recurso solicitado deve ser autorizado.',
        'unauthorized' => 'Desculpe, você não tem acesso ao recurso solicitado!',
        'moderated' => 'A sua conta atual foi moderada!',
        'unverified' => 'A sua conta atual não foi verificada!',
        'failed' => 'Essas credenciais não correspondem aos nossos registros.',
        'lockout' => 'Too many login attempts. Please try again in :seconds seconds.',
        'login' => 'Você fez login com sucesso!',
        'logout' => 'Você saiu com êxito!',
        'already' => 'Você já está autenticado!',
        'session' => [
            'required' => 'Você deve fazer login primeiro!',
            'expired' => 'Sessão expirada, faça o login novamente!',
            'flushed' => 'Sua sessão selecionada foi liberada com êxito!',
            'flushedall' => 'Todas as sessões ativas foram liberadas com êxito!',
        ],
    ],
];
