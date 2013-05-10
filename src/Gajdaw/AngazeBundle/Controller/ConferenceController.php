<?php

namespace Gajdaw\AngazeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Gajdaw\AngazeBundle\Entity\Conference;
use Gajdaw\AngazeBundle\Form\ConferenceType;

/**
 * Conference controller.
 *
 * @Route("/conference")
 */
class ConferenceController extends Controller
{
    /**
     * Lists all Conference entities.
     *
     * @Route("/", name="conference")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('GajdawAngazeBundle:Conference')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Conference entity.
     *
     * @Route("/", name="conference_create")
     * @Method("POST")
     * @Template("GajdawAngazeBundle:Conference:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Conference();
        $form = $this->createForm(new ConferenceType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('conference_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Conference entity.
     *
     * @Route("/new", name="conference_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Conference();
        $form   = $this->createForm(new ConferenceType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Conference entity.
     *
     * @Route("/{id}", name="conference_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GajdawAngazeBundle:Conference')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Conference entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Conference entity.
     *
     * @Route("/{id}/edit", name="conference_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GajdawAngazeBundle:Conference')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Conference entity.');
        }

        $editForm = $this->createForm(new ConferenceType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Conference entity.
     *
     * @Route("/{id}", name="conference_update")
     * @Method("PUT")
     * @Template("GajdawAngazeBundle:Conference:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GajdawAngazeBundle:Conference')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Conference entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new ConferenceType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('conference_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Conference entity.
     *
     * @Route("/{id}", name="conference_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('GajdawAngazeBundle:Conference')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Conference entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('conference'));
    }

    /**
     * Creates a form to delete a Conference entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
