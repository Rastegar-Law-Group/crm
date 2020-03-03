<?php

require_once('modules/ACLRoles/ACLRole.php');

/*
    * function: getSpecificRoledUser
    * params: name of role
    * return: list of all activated users related to this role
    * author: Farjad Ahmad - (farjadahmad3@gmail.com)
    * date: 01-Jan-2020
*/
function getSpecificRoledUser($role){
    $dataArray = [];
    $roleBean = BeanFactory::newBean('ACLRoles');
    $roleBean->retrieve_by_string_fields(['name' => $role]);
    if( !empty($roleBean->id) ){
        $roleBean->load_relationship('users');
        $users = $roleBean->users->getBeans();
        foreach( $users as $user ){
            $dataArray[$user->id] = $user->full_name;
        }   
    }
    return $dataArray;
}

?>