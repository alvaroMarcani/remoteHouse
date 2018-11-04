<?php

namespace AppBundle\Controller;

use AppBundle\AppBundle;
use AppBundle\Entity\House;
use AppBundle\Entity\Room;
use AppBundle\Form\RoomType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

/**
 * Room controller.
 *
 * @Route("room")
 */
class RoomController extends Controller
{
    /**
     * Lists all room entities.
     *
     * @Route("/", name="room_index")
     * @Method("GET")
     */
    public function indexAction()
    {

        $person=$this->getUser()->getPerson();

        $em = $this->getDoctrine()->getManager();

        if($person!=null){
            $rooms=$em->getRepository('AppBundle:Room')->getAllRoomsByPersona($person);
        }else{
            $rooms = $em->getRepository('AppBundle:Room')->findAll();
        }

        return $this->render('room/index.html.twig', array(
            'rooms' => $rooms,
        ));
    }

    /**
     * List
     *
     * @Route("/lightupdate", name="light_update", options={"expose"=true}, name="light_update")
     * @Method({"GET", "POST"})
     */
    public function lightUpdateAction(Request $request)
    {
        $data=$request->query->all();
        $em=$this->getDoctrine()->getManager();
        if(array_key_exists("id",$data)){
            $id=$data['id'];
            $room=$em->getRepository('AppBundle:Room')->findOneById($id);
            if($room!=null&array_key_exists("status",$data)){
                $status=false;
                if($data['status']=="true"){
                    $status=true;
                }
                $room->setLight($status);
                $em->persist($room);
                $em->flush();
                return new Response("true");
            }
        }
        return new Response("false");
    }

    /**
     * List
     *
     * @Route("/doorupdate", name="door_update", options={"expose"=true}, name="door_update")
     * @Method("POST")
     */
    public function doorUpdateAction(Request $request)
    {
       $data=$request->query->all();
        $em=$this->getDoctrine()->getManager();
        if(array_key_exists("id",$data)){
            $id=$data['id'];
            $room=$em->getRepository('AppBundle:Room')->findOneById($id);
            if($room!=null&array_key_exists("status",$data)){
                $status=false;
                if($data['status']=="true"){
                    $status=true;
                }
                $room->setDoor($status);
                $em->persist($room);
                $em->flush();
                return new Response("true");
            }
        }
        return new Response("false");
    }


    /**
     * List
     *
     * @Route("/roomdelete/{id}", name="room_delete2")
     * @Method({"DELETE","GET", "POST"})
     */
    public function delete2Action(Request $request, Room $room)
    {

        $form = $this->createDeleteForm($room);
        $form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();
        $em->remove($room);
        $em->flush();

        return $this->redirectToRoute('room_index');

    }

    /**
     * List
     *
     * @Route("/addroom", name="add_room")
     * @Method({"GET", "POST"})
     */
    public function addRoomAction(Request $request)
    {
//        var_dump($request->get('appbundle_room'));
//        $room=$request->get('appbundle_room');
        $room = new Room();
        $form = $this->createForm('AppBundle\Form\RoomType', $room, ['method' => $request->getMethod()]);
        $form->handleRequest($request);
        var_dump("nombre: ".$form["name"]->getData());
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($room);
            $em->flush();
            $this->addFlash("success", "Se ha agregado correctamente un nuevo cuarto");
            return $this->redirectToRoute('house_show', array('id' => $room->getIdHouse()->getId()));
        }
        $this->addFlash("warning", "El campo no puede estar vacio");
        return $this->redirectToRoute('house_show', array('id' => $this->getUser()->getPerson()->getId()));
    }

    /**
     * Creates a new room entity.
     *
     * @Route("/new", name="room_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $room = new Room();
        $form = $this->createForm('AppBundle\Form\RoomType', $room);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($room);
            $em->flush();
            return $this->redirectToRoute('room_show', array('id' => $room->getId()));
        }

        return $this->render('room/new.html.twig', array(
            'room' => $room,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a room entity.
     *
     * @Route("/{id}", name="room_show")
     * @Method("GET")
     */
    public function showAction(Room $room)
    {
        $deleteForm = $this->createDeleteForm($room);

        return $this->render('room/show.html.twig', array(
            'room' => $room,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing room entity.
     *
     * @Route("/{id}/edit", name="room_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Room $room)
    {
        $deleteForm = $this->createDeleteForm($room);
        $editForm = $this->createForm('AppBundle\Form\RoomType', $room);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('room_edit', array('id' => $room->getId()));
        }

        return $this->render('room/edit.html.twig', array(
            'room' => $room,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a room entity.
     *
     * @Route("/{id}", name="room_delete")
     * @Method({"DELETE", "GET", "POST"})
     */
    public function deleteAction(Request $request, Room $room)
    {
        var_dump("hola");
//        $form = $this->createDeleteForm($room);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $em = $this->getDoctrine()->getManager();
//            $em->remove($room);
//            $em->flush();
//            return $this->redirectToRoute('room_index');
//        }

//        return $this->redirectToRoute('room_index');
        return new Response("//////////////");
    }

    /**
     * Creates a form to delete a room entity.
     *
     * @param Room $room The room entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Room $room)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('room_delete', array('id' => $room->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

}
