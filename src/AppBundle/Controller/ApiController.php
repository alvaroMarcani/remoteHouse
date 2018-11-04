<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Room;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
/**
 * House controller.
 *
 * @Route("api")
 */
class ApiController extends Controller
{
    /**
     * @Route("/", name="api")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return new Response("data");
    }


    /**
     * Read states (id, token) then if all is correct returns room object with status for light and door (true, false)
     * @Route("/roomstatus", name="room_status")
     * @Method({"GET","POST"})
     */
    public function checkStatusAction(Request $request)
    {
        $data=$request->query->all();
        $em=$this->getDoctrine()->getManager();
        $jsonArray=[];
        if(array_key_exists('id',$data)&array_key_exists('token',$data)){
            $id=$data['id'];
            $room=$em->getRepository('AppBundle:Room')->findOneById($id);
            if($room!=null){
                $jsonArray=[
                  'id'=>$room->getId(),
                  'light'=>$room->getLight(),
                  'door'=>$room->getDoor(),
                ];
            }else{
                $jsonArray=[
                  'status'=>'no data',
                ];
            }
        }else{
            $jsonArray=[
                'status'=>'error',
            ];
        }
        return new JsonResponse($jsonArray);
    }
}
