<?php 

namespace App\Services;

use App\Repositories\Contracts\FollowerRepositoryContract;
use App\Repositories\Contracts\DogRepositoryContract;
use App\Repositories\Contracts\KennelRepositoryContract;

use App\Services\Contracts\NotificationServiceContract;
use App\Services\Contracts\FollowerServiceContract;

use Hash;
use Session;
use Auth;

class FollowerService implements FollowerServiceContract {

  public function __construct (
    FollowerRepositoryContract $followerRepository,
    DogRepositoryContract $dogRepository,
    KennelRepositoryContract $kennelRepository,
    NotificationService $notificationService
  )
  {
    $this->follower = $followerRepository;
    $this->dog = $dogRepository;
    $this->kennel = $kennelRepository;
    $this->notificationService = $notificationService;
  }

  public function create($type, $id)
  {

    $input['follower_id'] = Auth::user()->id;
    $input['followable_type'] = ucfirst($type);
    $input['followable_id'] = $id;
    
    $followed = $this->follower->checkUserFollowed(Auth::user()->id, $id);

    if (!$followed)
    {
      $follow = $this->follower->create($input);
    }

    // Notifications
    if ($type=='user')
    {
      $recipients = [$id];
      $notifiableType = 'App\User';
      $notifiableId = $id;
    };

    if ($type=='dog')
    {
      $dog = $this->dog->get($id);

      $recipients = $this->dog->getAssetUsers($id);
      $notifiableType = 'App\Dog';
      $notifiableId = $id;
    };

    if ($type=='kennel')
    {
      $kennel = $this->kennel->get($id);
      
      $recipients = $this->kennel->getAssetUsers($id);
      $notifiableType = 'App\Kennel';
      $notifiableId = $id;
    };

    $notificationInput = [
      'from_user_id' => Auth::user()->id,
      'type_id' => 2,
      'seen' => 0,
      'notifiable_type' => $notifiableType,
      'notifiable_id' => $notifiableId,
    ];

    foreach ($recipients as $user)
    {
      $notificationInput['user_id'] = $user;
      $this->notificationService->create($notificationInput);
    }


    return $follow;
  }


  public function delete($segment, $userid)
  {
    $user=Auth::user();

    $follow = $this->follower->getFollow(ucfirst($segment), $userid, $user->id);
    $this->follower->delete($follow->id);
  }



 
}