<?php

declare(strict_types=1);

namespace Thn\BackendTest\Infrastructure\Delivery\Action\Hotel;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Security;
use Thn\BackendTest\Application\Query\Hotel\HotelGet\GetHotelQuery;
use Thn\BackendTest\Application\Query\Hotel\HotelGet\GetHotelQueryHandler;
use Thn\BackendTest\Domain\Model\User\User;

class GetHotelAction extends AbstractController
{
    /** @var Security */
    private $securityManager;

    public function __construct(
        Security $securityManager,
        GetHotelQueryHandler $hotelQueryHandler
    ) {
        $this->securityManager = $securityManager;
        $this->hotelQueryHandler = $hotelQueryHandler;
    }

    public function __invoke(Request $request): Response
    {
        /** @var User $user */
        $user = $this->securityManager->getUser();

        /*var_dump($user);
        die();*/

        $includes = $request->query->get('include');
        $include = [];
        if (null !== $includes) {
            $include = explode(',', $includes);
        }

        $getHotelQuery = new GetHotelQuery(
            $user,
            $request->attributes->get('hotelId'),
            $include
        );

        return new JsonResponse(
            $this->hotelQueryHandler->__invoke($getHotelQuery)
        );
    }
}
