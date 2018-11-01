<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Person;
use AppBundle\Entity\Usuario;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Person controller.
 *
 * @Route("person")
 */
class PersonController extends Controller
{
    /**
     * Lists all person entities.
     *
     * @Route("/", name="person_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $people = $em->getRepository('AppBundle:Person')->findAll();

        return $this->render('person/index.html.twig', array(
            'people' => $people,
        ));
    }

    /**
     * Creates a new person entity.
     *
     * @Route("/new", name="person_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $person = new Person();
        $form = $this->createForm('AppBundle\Form\PersonType', $person);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();


            $file = $person->getPhoto();

            // if (!$passwd)
            //     $this->addFlash('danger', 'No se pudo crear el usuario');
            if ($file == null)
                $this->addFlash('danger', 'Debe subir una fotografia');
            else {

                $passwd = $em->getRepository('AppBundle:Usuario')->createUsuarioFromPersona($person, $this->container->get('fos_user.user_manager'));
                if (!$passwd){
                    var_dump($passwd);
                    $this->addFlash('danger', 'No se pudo crear el usuario');
                }
                else {
                    $fileName = md5(uniqid()).'.'.$file->guessExtension();
                    $file->move(
                        $this->getParameter('photos_directory'),
                        $fileName
                    );
                    $person->setPhoto($fileName);
                    $person->setStaticPhoto($fileName);
                    $em->persist($person);
                    $em->flush();

                    $this->addFlash('success', 'Se ha creado el usuario con el correo electrónico: '.$person->getEmail().' y contraseña: '.$passwd);
                    $this->addFlash('warning', 'Guarde esta Contraseña: '.$passwd);
                    return $this->redirectToRoute('person_new');
                }
            }

        }

        return $this->render('person/new.html.twig', array(
            'person' => $person,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a person entity.
     *
     * @Route("/{id}", name="person_show")
     * @Method("GET")
     */
    public function showAction(Person $person)
    {
        $deleteForm = $this->createDeleteForm($person);

        return $this->render('person/show.html.twig', array(
            'person' => $person,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing person entity.
     *
     * @Route("/{id}/edit", name="person_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Person $person)
    {
        $deleteForm = $this->createDeleteForm($person);
        $editForm = $this->createForm('AppBundle\Form\PersonType', $person);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

//            $person=new Person();
            $person->getUsuario()->setEmail($person->getEmail());
            //EDIT PHOTO METHOD
            $file=$person->getPhoto();
            if($file!=null){
                $file->move($this->getParameter('photos_directory'),
                    $person->getStaticPhoto());
                $person->setPhoto($person->getStaticPhoto());
            }else{
                $person->setPhoto($person->getStaticPhoto());
            }

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('person_edit', array('id' => $person->getId()));
        }

        return $this->render('person/edit.html.twig', array(
            'person' => $person,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a person entity.
     *
     * @Route("/{id}", name="person_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Person $person)
    {
        $form = $this->createDeleteForm($person);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($person);
            $em->flush();
        }

        return $this->redirectToRoute('person_index');
    }

    /**
     * Creates a form to delete a person entity.
     *
     * @param Person $person The person entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Person $person)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('person_delete', array('id' => $person->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
