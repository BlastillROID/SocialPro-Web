<?php

namespace SocialProBundle\Controller;

use SocialProBundle\Entity\Complaint;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Complaint controller.
 *
 */
class ComplaintController extends Controller
{
    /**
     * Lists all complaint entities.
     *
     */
    public function indexAction()
    {   $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();

        $complaints = $em->getRepository('SocialProBundle:Complaint')->findBy(array('employee' => $user));

        return $this->render('complaint/index.html.twig', array(
            'complaints' => $complaints,
            'user' => $user
        ));
    }
    public function backendlistcomplaintAction()
    {
        $em = $this->getDoctrine()->getManager();

        $complaints = $em->getRepository('SocialProBundle:Complaint')->findall();

        return $this->render('complaint/adindex.html.twig', array(
            'complaints' => $complaints,

        ));
    }
    public function backendshowcomplaintAction(Complaint $complaint)
    {
        $deleteForm = $this->createDeleteForm($complaint);

        return $this->render('complaint/adshow.html.twig', array(
            'complaint' => $complaint,
            'delete_form' => $deleteForm->createView(),

        ));
    }
    /**
     * Creates a new complaint entity.
     *
     */
    public function newAction(Request $request)
    { $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }
        $complaint = new Complaint();
        $form = $this->createForm('SocialProBundle\Form\ComplaintType', $complaint);
        $form->handleRequest($request);
        $complaint->setDateComplaint(new \DateTime('now'));
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $complaint->setEmployee($user);
            $em->persist($complaint);
            $em->flush($complaint);

            return $this->redirectToRoute('complaint_detail', array('id' => $complaint->getComplaintId()));
        }

        return $this->render('complaint/new.html.twig', array(
            'complaint' => $complaint,
            'form' => $form->createView(),
            'user' => $user
        ));
    }

    /**
     * Finds and displays a complaint entity.
     *
     */
    public function showAction(Complaint $complaint)
    {
        $deleteForm = $this->createDeleteForm($complaint);

        return $this->render('complaint/show.html.twig', array(
            'complaint' => $complaint,
            'delete_form' => $deleteForm->createView(),
        ));
    }
    public function detailAction(Complaint $complaint)
    {   $user = $this->getUser();
        $deleteForm = $this->createDeleteForm($complaint);

        return $this->render('complaint/detail.html.twig', array(
            'complaint' => $complaint,
            'delete_form' => $deleteForm->createView(),
            'user' => $user
        ));
    }

    /**
     * Displays a form to edit an existing complaint entity.
     *
     */
    public function editAction(Request $request, Complaint $complaint)
    {
        $deleteForm = $this->createDeleteForm($complaint);
        $editForm = $this->createForm('SocialProBundle\Form\ComplaintType', $complaint);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('complaint_edit', array('id' => $complaint->getComplaintId()));
        }

        return $this->render('complaint/edit.html.twig', array(
            'complaint' => $complaint,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a complaint entity.
     *
     */
    public function deleteAction(Request $request, Complaint $complaint)
    {
        $form = $this->createDeleteForm($complaint);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($complaint);
            $em->flush($complaint);
        }

        return $this->redirectToRoute('complaint_index');
    }

    /**
     * Creates a form to delete a complaint entity.
     *
     * @param Complaint $complaint The complaint entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Complaint $complaint)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('complaint_delete', array('id' => $complaint->getComplaintId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
