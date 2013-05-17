<?php

namespace Gajdaw\AngazeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Gajdaw\AngazeBundle\Entity\EmployeeSubject;
use Gajdaw\AngazeBundle\Form\EmployeeSubjectType;

/**
 * EmployeeSubject controller.
 *
 * @Route("/employeesubject")
 */
class EmployeeSubjectController extends Controller
{
    /**
     * Lists all EmployeeSubject entities.
     *
     * @Route("/", name="employeesubject")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('GajdawAngazeBundle:EmployeeSubject')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new EmployeeSubject entity.
     *
     * @Route("/", name="employeesubject_create")
     * @Method("POST")
     * @Template("GajdawAngazeBundle:EmployeeSubject:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new EmployeeSubject();
        $form = $this->createForm(new EmployeeSubjectType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('employeesubject_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new EmployeeSubject entity.
     *
     * @Route("/new", name="employeesubject_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new EmployeeSubject();
        $form   = $this->createForm(new EmployeeSubjectType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a EmployeeSubject entity.
     *
     * @Route("/{id}", name="employeesubject_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GajdawAngazeBundle:EmployeeSubject')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EmployeeSubject entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing EmployeeSubject entity.
     *
     * @Route("/{id}/edit", name="employeesubject_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GajdawAngazeBundle:EmployeeSubject')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EmployeeSubject entity.');
        }

        $editForm = $this->createForm(new EmployeeSubjectType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing EmployeeSubject entity.
     *
     * @Route("/{id}", name="employeesubject_update")
     * @Method("PUT")
     * @Template("GajdawAngazeBundle:EmployeeSubject:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GajdawAngazeBundle:EmployeeSubject')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EmployeeSubject entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new EmployeeSubjectType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('employeesubject_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a EmployeeSubject entity.
     *
     * @Route("/{id}", name="employeesubject_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('GajdawAngazeBundle:EmployeeSubject')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find EmployeeSubject entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('employeesubject'));
    }

    /**
     * Creates a form to delete a EmployeeSubject entity by id.
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
