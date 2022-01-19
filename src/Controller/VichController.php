<?php

namespace App\Controller;

use App\Entity\Invoice;
use App\Form\InvoiceType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VichController extends AbstractController
{
    /**
     * @Route("/vich", name="vich_index")
     */
    public function index(): Response
    {
        $repository = $this->getDoctrine()->getRepository(Invoice::class);
        $invoices = $repository->findAll();
        // replace this example code with whatever you need
        return $this->render('vich/index.html.twig', ['invoices' => $invoices]);
    }

    /**
     * @Route("/vich_new", name="vich_new")
     * @Route("/vich_edit/{id}", name="vich_edit")
     */
    public function newAction(Request $request, Invoice $invoice = null)
    {
        if (!$invoice){
            $invoice = new Invoice();
        }

        $form = $this->createForm(InvoiceType::class, $invoice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($invoice);
            $em->flush();

            $this->addFlash('success',
                'Successfully saved'
            );

            return $this->redirectToRoute('vich_index');
        }

        return $this->render('vich/vich.form.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
