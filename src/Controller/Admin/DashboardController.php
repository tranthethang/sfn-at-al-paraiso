<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Entity\Channel;
use App\Entity\ChannelUsed;
use App\Entity\Guest;
use App\Entity\Hotel;
use App\Entity\InvoiceGuest;
use App\Entity\Reservation;
use App\Entity\ReservationStatusCatalog;
use App\Entity\ReservationStatusEvent;
use App\Entity\Room;
use App\Entity\RoomType;
use App\Entity\Synchronization;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        return $this->render('/admin/dashboard/index.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('At Al Paraiso');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fas fa-chart-line');

        yield MenuItem::section("Customer");
        yield MenuItem::linkToCrud('Guest', 'fas fa-users', Guest::class);

        yield MenuItem::section("Hotel");
        yield MenuItem::linkToCrud('Category', 'fas fa-layer-group', Category::class);
        yield MenuItem::linkToCrud('Hotel', 'fas fa-hotel', Hotel::class);

        yield MenuItem::section("Room");
        yield MenuItem::linkToCrud('Room Type', 'fas fa-campground', RoomType::class);
        yield MenuItem::linkToCrud('Room', 'fas fa-house-user', Room::class);

        yield MenuItem::section("Reservation");
        yield MenuItem::linkToCrud('Reservation', 'fas fa-check-to-slot', Reservation::class);
        yield MenuItem::linkToCrud('Reservation Status', 'fas fa-toggle-off', ReservationStatusCatalog::class);
        yield MenuItem::linkToCrud('Reservation Event', 'fas fa-calendar', ReservationStatusEvent::class);

        yield MenuItem::section("Channel");
        yield MenuItem::linkToCrud('Channel', 'fas fa-link', Channel::class);
        yield MenuItem::linkToCrud('Channel Used', 'fas fa-link', ChannelUsed::class);
        yield MenuItem::linkToCrud('Synchronization', 'fas fa-link', Synchronization::class);

        yield MenuItem::section("Invoice");
        yield MenuItem::linkToCrud('Invoice', 'fas fa-receipt', InvoiceGuest::class);
    }
}
