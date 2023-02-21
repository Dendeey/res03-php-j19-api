<?php


class UserController extends AbstractController {
    private UserManager $um;

    public function __construct()
    {
        $this->um = new UserManager();
    }

    public function getUsers()
    {
        // get all the users from the manager
        
        $usersToShow = $this->um->getAllUsers();

        // render
        
        $usersToShowInArray = [];
        foreach($usersToShow as $user)
        {
            $userToAarray= $user->toArray();
            $usersToShowInArray[] = $userToAarray;
        }
        $this->render($usersToShowInArray);
        
    }

    public function getUser(string $get)
    {
        // get the user from the manager
        
        $getUserFromManager = $this->um->getUserById();
        
        // either by email or by id
        
        $getUserById = $this->um->getUserById();
        
        // render
        
        $getUserById->toArray();
        
        $this->render($getUserById);
        
        
    }

    public function createUser(array $post)
    {
        // create the user in the manager
        
        $createUser = $this->um->createUser();
        
        // render the created user
        
        $this->render($createUser);
    }

    public function updateUser(array $post)
    {
        // update the user in the manager
        
        $updateUser = $this->um->updateUser();

        // render the updated user
        
        $this->render($updateUser);
    }

    public function deleteUser(array $post)
    {
        // delete the user in the manager
        
        $deleteUser = $this->um->deleteUser();

        // render the list of all users
        
        $this->render($deleteUser);
    }
}

?>