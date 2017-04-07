<?php

namespace AppBundle\Controller;

use AppBundle\Entity\PastorLocal;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Pastorlocal controller.
 *
 * @Route("pastorlocal")
 */
class PastorLocalController extends Controller
{
    /**
     * Lists all pastorLocal entities.
     *
     * @Route("/", name="pastorlocal_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $pastorLocals = $em->getRepository('AppBundle:PastorLocal')->findAll();

        return $this->render('pastorlocal/index.html.twig', array(
            'pastorLocals' => $pastorLocals,
        ));
    }

    /**
     * Creates a new pastorLocal entity.
     *
     * @Route("/new", name="pastorlocal_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $pastorLocal = new Pastorlocal();
        $form = $this->createForm('AppBundle\Form\PastorLocalType', $pastorLocal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($pastorLocal);
            $em->flush($pastorLocal);

            return $this->redirectToRoute('pastorlocal_show', array('id' => $pastorLocal->getId()));
        }

        return $this->render('pastorlocal/new.html.twig', array(
            'pastorLocal' => $pastorLocal,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a pastorLocal entity.
     *
     * @Route("/{id}", name="pastorlocal_show")
     * @Method("GET")
     */
    public function showAction(PastorLocal $pastorLocal)
    {
        $deleteForm = $this->createDeleteForm($pastorLocal);

        return $this->render('pastorlocal/show.html.twig', array(
            'pastorLocal' => $pastorLocal,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing pastorLocal entity.
     *
     * @Route("/{id}/edit", name="pastorlocal_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, PastorLocal $pastorLocal)
    {
        $deleteForm = $this->createDeleteForm($pastorLocal);
        $editForm = $this->createForm('AppBundle\Form\PastorLocalType', $pastorLocal);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('pastorlocal_edit', array('id' => $pastorLocal->getId()));
        }

        return $this->render('pastorlocal/edit.html.twig', array(
            'pastorLocal' => $pastorLocal,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a pastorLocal entity.
     *
     * @Route("/{id}", name="pastorlocal_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, PastorLocal $pastorLocal)
    {
        $form = $this->createDeleteForm($pastorLocal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($pastorLocal);
            $em->flush();
        }

        return $this->redirectToRoute('pastorlocal_index');
    }

    /**
     * Creates a form to delete a pastorLocal entity.
     *
     * @param PastorLocal $pastorLocal The pastorLocal entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(PastorLocal $pastorLocal)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('pastorlocal_delete', array('id' => $pastorLocal->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
