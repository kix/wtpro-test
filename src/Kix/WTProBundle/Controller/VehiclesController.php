<?php

namespace Kix\WTProBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use Kix\WTProBundle\Entity;
use Kix\WTProBundle\Form;

/**
 * Created by JetBrains PhpStorm.
 * User: kix
 * Date: 26.11.12
 * Time: 17:25
 * To change this template use File | Settings | File Templates.
 */
class VehiclesController extends Controller
{

    /**
     * @Route("/models/", name="wtpro_models_list")
     * @Template()
     * @Method("GET")
     */
    public function allAction()
    {
        $models = $this->getDoctrine()->getRepository('KixWTProBundle:VehicleModel')->findAll();

        return array('models' => $models);
    }

    /**
     * @Route("/models/form/{id}", name="wtpro_models_form", defaults={"id": false}, requirements={"id": "\d+"})
     * @Template()
     * @Method({"GET", "POST"})
     */
    public function formAction($id)
    {
        $request = $this->getRequest();

        if ($id) {
            $model = $this->getDoctrine()->getRepository('KixWTProBundle:VehicleModel')->find($id);

            if (!$model instanceof Entity\VehicleModel) {
                throw $this->createNotFoundException(sprintf('No vehicle model found for ID %s', $id));
            }
        } else {
            $model = new Entity\VehicleModel();
        }

        $form = $this->createForm(new Form\VehicleModelType(), $model);

        if ($request->getMethod() == "POST") {
            $form->bind($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();

                $em->persist($model);
                $em->flush();

                return $this->redirect($this->get('router')->generate('wtpro_models_list'));
            }
        }

        return array(
            'form'   => $form->createView(),
            'id'     => $id,
        );
    }

}
