<?php

function permission_check($permission_name) {
    $user = auth()->user();
    if (!$user->can($permission_name)) {
        flash()->addWarning('You are not authorized to access this page');
        echo redirect()->back();
        exit;
    }
}