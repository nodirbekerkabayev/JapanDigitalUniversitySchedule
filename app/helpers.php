<?php

function success($data = null)
{
    if($data != null){
        return response()->json(['status' => 'success', 'data' => $data]);
    }
    return response()->json(['status' => 'success']);
}
