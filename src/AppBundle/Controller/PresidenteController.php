<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Presidente;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Presidente controller.
 *
 * @Route("presidente")
 */
class PresidenteController extends Controller
{
    /**
     * Lists all presidente entities.
     *
     * @Route("/", name="presidente_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $presidentes = $em->getRepository('AppBundle:Presidente')->findAll();

        return $this->render('presidente/index.html.twig', array(
            'presidentes' => $presidentes,
        ));
    }

    /**
     * Creates a new presidente entity.
     *
     * @Route("/new", name="presidente_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $presidente = new Presidente();
        $form = $this->createForm('AppBundle\Form\PresidenteType', $presidente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $encoder = $this->container->get('security.password_encoder');
            $encoded = $encoder->encodePassword($presidente, $presidente->getPassword());

            $presidente->setPassword($encoded);

            $em = $this->getDoctrine()->getManager();
            $em->persist($presidente);
            $em->flush($presidente);

            return $this->redirectToRoute('presidente_show', array('id' => $presidente->getId() ) );
        }

        return $this->render('presidente/new.html.twig', array(
            'presidente' => $presidente,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a presidente entity.
     *
     * @Route("/{id}", name="presidente_show")
     * @Method("GET")
     */
    public function showAction(Presidente $presidente)
    {
        $deleteForm = $this->createDeleteForm($presidente);

        return $this->render('presidente/show.html.twig', array(
            'presidente' => $presidente,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing presidente entity.
     *
     * @Route("/{id}/edit", name="presidente_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Presidente $presidente)
    {
        $deleteForm = $this->createDeleteForm($presidente);
        $editForm = $this->createForm('AppBundle\Form\PresidenteType', $presidente);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('presidente_edit', array('id' => $presidente->getId()));
        }

        return $this->render('presidente/edit.html.twig', array(
            'presidente' => $presidente,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a presidente entity.
     *
     * @Route("/{id}", name="presidente_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Presidente $presidente)
    {
        $form = $this->createDeleteForm($presidente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($presidente);
            $em->flush();
        }

        return $this->redirectToRoute('presidente_index');
    }

    /**
     * Creates a form to delete a presidente entity.
     *
     * @param Presidente $presidente The presidente entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Presidente $presidente)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('presidente_delete', array('id' => $presidente->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
