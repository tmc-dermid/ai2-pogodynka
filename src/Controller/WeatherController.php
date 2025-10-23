<?php

namespace App\Controller;

use App\Entity\Location;
use App\Repository\LocationRepository;
use App\Repository\MeasurementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class WeatherController extends AbstractController
{
    #[Route('/weather/{city}', name: 'app_weather', requirements: ['city' => '[a-zA-Z]+'])]
    public function city(string $city, LocationRepository $location, MeasurementRepository $repository): Response
    {
        $location = $location->findOneBy(['city' => $city]);

        $measurements = $repository->findByLocation($location);

        return $this->render('weather/city.html.twig', [
            'location' => $location,
            'measurements' => $measurements,
        ]);
    }

    #[Route('/weather/{city}/{country}', name: 'app_weather_city_country', requirements: ['city' => '[a-zA-Z]+', 'country' => '[A-Z]{2}'])]
    public function city_country(string $city, string $country, LocationRepository $location, MeasurementRepository $repository): Response
    {
        $location = $location->findOneBy(['city' => $city, 'country' => $country]);

        $measurements = $repository->findByLocation($location);

        return $this->render('weather/city.html.twig', [
            'location' => $location,
            'measurements' => $measurements,
        ]);
    }
}
