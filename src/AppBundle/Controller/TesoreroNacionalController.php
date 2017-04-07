<?php

namespace AppBundle\Controller;

use AppBundle\Entity\TesoreroNacional;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Tesoreronacional controller.
 *
 * @Route("tesoreronacional")
 */
class TesoreroNacionalController extends Controller
{
    /**
     * Lists all tesoreroNacional entities.
     *
     * @Route("/", name="tesoreronacional_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tesoreroNacionals = $em->getRepository('AppBundle:TesoreroNacional')->findAll();

        return $this->render('tesoreronacional/index.html.twig', array(
            'tesoreroNacionals' => $tesoreroNacionals,
        ));
    }

    /**
     * Creates a new tesoreroNacional entity.
     *
     * @Route("/new", name="tesoreronacional_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $tesoreroNacional = new Tesoreronacional();
        $form = $this->createForm('AppBundle\Form\TesoreroNacionalType', $tesoreroNacional);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tesoreroNacional);
            $em->flush($tesoreroNacional);

            return $this->redirectToRoute('tesoreronacional_show', array('id' => $tesoreroNacional->getId()));
        }

        return $this->render('tesoreronacional/new.html.twig', array(
            'tesoreroNacional' => $tesoreroNacional,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a tesoreroNacional entity.
     *
     * @Route("/{id}", name="tesoreronacional_show")
     * @Method("GET")
     */
    public function showAction(TesoreroNacional $tesoreroNacional)
    {
        $deleteForm = $this->createDeleteForm($tesoreroNacional);

        return $this->render('tesoreronacional/show.html.twig', array(
            'tesoreroNacional' => $tesoreroNacional,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing tesoreroNacional entity.
     *
     * @Route("/{id}/edit", name="tesoreronacional_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, TesoreroNacional $tesoreroNacional)
    {
        $deleteForm = $this->createDeleteForm($tesoreroNacional);
        $editForm = $this->createForm('AppBundle\Form\TesoreroNacionalType', $tesoreroNacional);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tesoreronacional_edit', array('id' => $tesoreroNacional->getId()));
        }

        return $this->render('tesoreronacional/edit.html.twig', array(
            'tesoreroNacional' => $tesoreroNacional,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a tesoreroNacional entity.
     *
     * @Route("/{id}", name="tesoreronacional_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, TesoreroNacional $tesoreroNacional)
    {
        $form = $this->createDeleteForm($tesoreroNacional);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tesoreroNacional);
            $em->flush();
        }

        return $this->redirectToRoute('tesoreronacional_index');
    }

    /**
     * Creates a form to delete a tesoreroNacional entity.
     *
     * @param TesoreroNacional $tesoreroNacional The tesoreroNacional entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(TesoreroNacional $tesoreroNacional)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tesoreronacional_delete', array('id' => $tesoreroNacional->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
