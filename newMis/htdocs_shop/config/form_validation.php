<?php

$config = array(
    'role' => array(
        array(
            'field' => 'role_code',
            'label' => '角色编码',
            'rules' => 'required|is_unique[role_info.role_code]'
        ),
        array(
            'field' => 'role_name',
            'label' => '角色名称',
            'rules' => 'required|is_unique[role_info.role_name]'
        )
    ),
    /**
     * 添加用户规则
     */
    'admin' => array(
        array(
            'field' => 'username',
            'label' => '用户名',
            'rules' => 'required|min_length[3]|max_length[12]|alpha_dash'
        ),
        array(
            'field' => 'name',
            'label' => '真实姓名',
            'rules' => 'required|min_length[3]|max_length[12]'
        ),
        array(
            'field' => 'phone',
            'label' => '手机号码',
            'rules' => 'required|min_length[11]|integer'
        ),
        array(
            'field' => 'email',
            'label' => '邮箱',
            'rules' => 'required|valid_email'
        ),
         array(
            'field' => 'password_hash',
            'label' => '第一次密码',
            'rules' => 'required|min_length[6]|max_length[18]'
        ),
         array(
            'field' => 'password_reset_token',
            'label' => '确认密码',
            'rules' => 'required|matches[password_hash]|min_length[6]|max_length[18]'
        ),
        

    )

);
