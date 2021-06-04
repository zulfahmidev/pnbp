<?php
require_once '../vendor/autoload.php';
if (isset($_POST['data'])) {

    $url = 'assets/img/';
    $data = json_decode($_POST['data'], true);
    
    
    // var_dump($_FILES);
    // die;
    if (isset($_FILES['image'])) {

        if($_FILES["image"]['name'] != ''){
    
            $image = new Bulletproof\Image($_FILES);
            $image_name = '';
    
            $image->setMime(array('png', 'jpg', 'jpeg'))
                ->setLocation('../assets/img')
                ->setSize(5000, 8388608)
                ->setDimension(10000,10000);
    
            if ($image['image']) {
                $upload = $image->upload(); 
        
                if($upload){
                    $image_name = $upload->getName().'.'.$image->getMime(); // uploads/cat.gif
                    if ($_POST['image_name'] == 'ap_items') {
                        if (isset($_POST['edit'])) {
                            unlink(__DIR__.'/../'.$data['ap_items'][$_POST['edit']]['image']);
                            $data['ap_items'][$_POST['edit']]['image'] = $url.$image_name;
                        }else {
                            $data['ap_items'][count($data['ap_items'])-1]['image'] = $url.$image_name;
                        }
                    }else {
                        unlink(__DIR__.'/../'.$data[$_POST['image_name']]);
                        $data[$_POST['image_name']] = $url.$image_name;
                    }
                }else{
                    echo $image->getError(); 
                }
            }
            
        }
    }
    
    file_put_contents('../data.json',json_encode($data));
}

if (isset($_POST['image'])) {
    echo json_encode(['message' => 'success']);
}