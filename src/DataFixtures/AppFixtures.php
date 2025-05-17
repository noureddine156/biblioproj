<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $this->loadUsers($manager);
        $this->loadCategories($manager);
        
        $manager->flush();
    }
    
    private function loadUsers(ObjectManager $manager): void
    {
        // Create an admin user
        $admin = new User();
        $admin->setEmail('admin@biblio.com');
        $admin->setFirstName('Admin');
        $admin->setLastName('User');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword(
            $this->passwordHasher->hashPassword($admin, 'admin123')
        );
        
        $manager->persist($admin);
        
        // Create a regular user
        $user = new User();
        $user->setEmail('user@biblio.com');
        $user->setFirstName('Regular');
        $user->setLastName('User');
        $user->setRoles(['ROLE_USER']);
        $user->setPassword(
            $this->passwordHasher->hashPassword($user, 'user123')
        );
        
        $manager->persist($user);
    }
    
    private function loadCategories(ObjectManager $manager): void
    {
        $categories = [
            'Fiction' => 'Fictional literature genre',
            'Non-Fiction' => 'Literature that is based on facts',
            'Science Fiction' => 'Fiction dealing with imagined future scientific advances',
            'Mystery' => 'Fiction dealing with the solution of a crime or puzzle',
            'Biography' => 'Account of someone\'s life written by someone else',
            'History' => 'Books focusing on historical events',
            'Self-Help' => 'Books for personal improvement',
            'Reference' => 'Books providing factual information'
        ];
        
        foreach ($categories as $name => $description) {
            $category = new \App\Entity\Category();
            $category->setName($name);
            $category->setDescription($description);
            $manager->persist($category);
            
            $this->addReference('category_'.$name, $category);
        }
    }
}
