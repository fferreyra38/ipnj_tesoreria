<?php

namespace AppBundle\Controller;

use AppBundle\Entity\TesoreroLocal;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Tesorerolocal controller.
 *
 * @Route("tesorerolocal")
 */
class TesoreroLocalController extends Controller
{
    /**
     * Lists all tesoreroLocal entities.
     *
     * @Route("/", name="tesorerolocal_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tesoreroLocals = $em->getRepository('AppBundle:TesoreroLocal')->findAll();

        return $this->render('tesorerolocal/index.html.twig', array(
            'tesoreroLocals' => $tesoreroLocals,
        ));
    }

    /**
     * Creates a new tesoreroLocal entity.
     *
     * @Route("/new", name="tesorerolocal_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $tesoreroLocal = new Tesorerolocal();
        $form = $this->createForm('AppBundle\Form\TesoreroLocalType', $tesoreroLocal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tesoreroLocal);
            $em->flush($tesoreroLocal);

            return $this->redirectToRoute('tesorerolocal_show', array('id' => $tesoreroLocal->getId()));
        }

        return $this->render('tesorerolocal/new.html.twig', array(
            'tesoreroLocal' => $tesoreroLocal,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a tesoreroLocal entity.
     *
     * @Route("/{id}", name="tesorerolocal_show")
     * @Method("GET")
     */
    public function showAction(TesoreroLocal $tesoreroLocal)
    {
        $deleteForm = $this->createDeleteForm($tesoreroLocal);

        return $this->render('tesorerolocal/show.html.twig', array(
            'tesoreroLocal' => $tesoreroLocal,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing tesoreroLocal entity.
     *
     * @Route("/{id}/edit", name="tesorerolocal_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, TesoreroLocal $tesoreroLocal)
    {
        $deleteForm = $this->createDeleteForm($tesoreroLocal);
        $editForm = $this->createForm('AppBundle\Form\TesoreroLocalType', $tesoreroLocal);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tesorerolocal_edit', array('id' => $tesoreroLocal->getId()));
        }

        return $this->render('tesorerolocal/edit.html.twig', array(
            'tesoreroLocal' => $tesoreroLocal,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a tesoreroLocal entity.
     *
     * @Route("/{id}", name="tesorerolocal_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, TesoreroLocal $tesoreroLocal)
    {
        $form = $this->createDeleteForm($tesoreroLocal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tesoreroLocal);
            $em->flush();
        }

        return $this->redirectToRoute('tesorerolocal_index');
    }

    /**
     * Creates a form to delete a tesoreroLocal entity.
     *
     * @param TesoreroLocal $tesoreroLocal The tesoreroLocal entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(TesoreroLocal $tesoreroLocal)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tesorerolocal_delete', array('id' => $tesoreroLocal->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
