<?php

namespace Gajdaw\AngazeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Gajdaw\AngazeBundle\Entity\Journey;
use Gajdaw\AngazeBundle\Form\JourneyType;

/**
 * Journey controller.
 *
 * @Route("/journey")
 */
class JourneyController extends Controller
{
    /**
     * Lists all Journey entities.
     *
     * @Route("/", name="journey")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('GajdawAngazeBundle:Journey')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Journey entity.
     *
     * @Route("/", name="journey_create")
     * @Method("POST")
     * @Template("GajdawAngazeBundle:Journey:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Journey();
        $form = $this->createForm(new JourneyType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('journey_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Journey entity.
     *
     * @Route("/new", name="journey_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Journey();
        $form   = $this->createForm(new JourneyType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Journey entity.
     *
     * @Route("/{id}", name="journey_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GajdawAngazeBundle:Journey')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Journey entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Journey entity.
     *
     * @Route("/{id}/edit", name="journey_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GajdawAngazeBundle:Journey')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Journey entity.');
        }

        $editForm = $this->createForm(new JourneyType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Journey entity.
     *
     * @Route("/{id}", name="journey_update")
     * @Method("PUT")
     * @Template("GajdawAngazeBundle:Journey:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GajdawAngazeBundle:Journey')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Journey entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new JourneyType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('journey_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Journey entity.
     *
     * @Route("/{id}", name="journey_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('GajdawAngazeBundle:Journey')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Journey entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('journey'));
    }

    /**
     * Creates a form to delete a Journey entity by id.
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
