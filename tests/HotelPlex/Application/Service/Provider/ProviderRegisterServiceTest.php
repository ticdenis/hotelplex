<?php

declare(strict_types=1);

namespace HotelPlex\Tests\Application\Service\Provider;

use HotelPlex\Application\Presenter\EmptyPresenter;
use HotelPlex\Application\Service\Provider\ProviderRegisterRequest;
use HotelPlex\Application\Service\Provider\RegisterProviderService;
use HotelPlex\Domain\Entity\Provider\Provider;
use HotelPlex\Domain\Event\DomainEventPublisher;
use HotelPlex\Domain\Event\Provider\ProviderRegistered;
use HotelPlex\Domain\Repository\Provider\ProviderRepository;
use HotelPlex\Tests\Infrastructure\Domain\Event\SpyDomainEventListener;
use HotelPlex\Tests\Infrastructure\Domain\Factory\FakerProviderFactory;
use PHPUnit\Framework\TestCase;
use Tasky\Domain\Model\Provider\ProviderInvalidEmailException;

final class ProviderRegisterServiceTest extends TestCase
{

    /**
     * @var Provider
     */
    private $mockProvider;

    /**
     * @var ProviderRegisterRequest
     */
    private $request;

    /**
     *
     * @throws ProviderInvalidEmailException
     */
    protected function setUp()
    {
        $this->mockProvider = FakerProviderFactory::create();
        $this->request = new ProviderRegisterRequest(
            $this->mockProvider->uuid()->value(),
            $this->mockProvider->username(),
            $this->mockProvider->email()->value(),
            $this->mockProvider->password()->value()
        );
    }

    /**
     * @test
     * @throws ProviderInvalidEmailException
     */
    public function shouldRegisterProvider()
    {
        // Arrange
        $mockProvider = $this->mockProvider;

        $mockRepository = $this->getMockBuilder(ProviderRepository::class)
            ->setMethods(['create', 'ofEmailAndPassword'])->getMock();

        // Assert
        $mockRepository->expects($this->once())
            ->method('create')
            ->with($this->callback(function (Provider $provider) use ($mockProvider) {
                return
                    $provider->uuid()->equalsTo($mockProvider->uuid()) &&
                    $provider->username() === $mockProvider->username() &&
                    $provider->email()->equalsTo($mockProvider->email());
            }));

        // Action
        $service = new RegisterProviderService($mockRepository);
        $service->__invoke($this->request, new EmptyPresenter());
    }

    /**
     * @test
     */
    public function shouldEventRegistered()
    {
        // Arrange
        $eventSubscriber = new SpyDomainEventListener();
        $id = DomainEventPublisher::instance()->subscribe($eventSubscriber);

        $mockRepository = $this->createMock(ProviderRepository::class);

        // Action
        $service = new RegisterProviderService($mockRepository);
        $service->__invoke($this->request, new EmptyPresenter());

        DomainEventPublisher::instance()->unsubscribe($id);
        $domainEvent = $eventSubscriber->domainEvent();

        // Assert
        $this->assertInstanceOf(ProviderRegistered::class, $domainEvent);
        $this->assertTrue($this->mockProvider->uuid()->value() === $domainEvent->id());
    }


}
