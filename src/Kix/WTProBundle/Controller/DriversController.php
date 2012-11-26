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
class DriversController extends Controller
{

    const DRIVERS_PER_PAGE = 10;

    /**
     * @Route("/drivers/{page}", defaults={"page": 1}, name="wtpro_drivers_list", requirements={"page": "\d+"})
     * @Template()
     * @Method("GET")
     */
    public function allAction($page = 1)
    {
        $repo = $this->getDoctrine()->getRepository('KixWTProBundle:Driver');
        $drivers = $repo->findBy(
            array(),
            array(),
            self::DRIVERS_PER_PAGE,
            self::DRIVERS_PER_PAGE * ($page -1)
        );

        return array(
            'drivers' => $drivers,
            'currentPage'    => $page,
            'pages'          => (int) (count($repo->findAll()) / self::DRIVERS_PER_PAGE) + 1,
        );
    }

    /**
     * @Route("/drivers/form/{id}", name="wtpro_drivers_form", defaults={"id": false})
     * @Template()
     * @Method({"GET", "POST"})
     *
     * @param $id
     */
    public function formAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        if ($id) {
            $driver = $em->getRepository('KixWTProBundle:Driver')->find($id);

            if (!$driver instanceof Entity\Driver) {
                throw $this->createNotFoundException(sprintf('Driver with id %s doen not exist', $id));
            }
        } else {
            $driver = new Entity\Driver();
        }

        $form = $this->createForm(new Form\DriverType(), $driver);
        $request = $this->getRequest();

        if ($request->getMethod() == 'POST') {
            $form->bind($request);

            if ($form->isValid()) {
                $em->persist($driver);
                $em->flush();

                return $this->redirect($this->get('router')->generate('wtpro_drivers_list'));
            }
        }

        return array(
            'form'  => $form->createView(),
            'id'    => $id,
        );
    }

    /**
     * @Route(
     *      "/drivers/{id}/toggle.{_format}",
     *      defaults={"_format": "json"},
     *      requirements={"id": "\d+"},
     *      name="wtpro_drivers_toggle"
     * )
     */
    public function toggleActiveAction($id, $_format)
    {
        $em = $this->getDoctrine()->getManager();

        $driver = $em->getRepository('KixWTProBundle:Driver')->find($id);

        if (!$driver instanceof Entity\Driver) {
            throw $this->createNotFoundException(sprintf('Driver with id %s does not exist', $id));
        }

        $driver->toggleActive();
        $em->persist($driver);
        $em->flush();

        $response = array(
            'success' => true,
            'driver'  => $driver->toArray()
        );

        return new \Symfony\Component\HttpFoundation\Response(json_encode($response));
    }

}
