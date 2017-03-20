<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction( Request $request )
    {
        // replace this example code with whatever you need
        $response = $this->render( 'default/index.html.twig', [
            'base_dir' => realpath( $this->getParameter( 'kernel.root_dir' ) . '/..' ) . DIRECTORY_SEPARATOR,
        ] );
        $resptxt = <<<EOBLA
<!DOCTYPE html>
<html>
    <body>
        <div id="container">
                <h1><span>Welcomee to</span> Symfony 3.2.4 mava</h1>


        </div>
            </body>
</html>
EOBLA;

        $resptxt = "<html>\n<head/>\n<body>\n<p>Hello World</p>\n</body>\n</html>";
        $response = new Response(
            $resptxt,
            Response::HTTP_OK,
            ['content-type' => 'text/html']
        );
        return $response;
    }

    /**
     * @Route("/about/{name}", name="aboutpage", defaults={"name":null})
     */
    public function aboutAction( $name )
    {
        if ( $name )
        {
            $user = $this->getDoctrine()->getRepository( 'AppBundle:User' )->findOneBy( [ 'name' => $name ] );
            if ( false === $user instanceof User )
            {
                throw $this->createNotFoundException( 'No user named ' . $name . ' found!' );
            }
        }
        return $this->render( 'about/index.html.twig', [
            'user' => $user
        ] );
    }
}
