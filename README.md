## 1st step  
Install JMS serializer bundle with composer  
On Symfony 4 version, check bundles.php in config folder and ADD   
JMS\SerializerBundle\JMSSerializerBundle::class => ['all' => true]  
You can now use SerializerInterface in your method with construct or with injection dependancies  
When using JMS this way you don't need to use it in services.yaml neither appkernel  
 
## 2nd step 
Install ORM Doctrine  
Create the data base using the ORM Doctrine  
Create the entity Article symfony console make:entity  
Creation of Article Controller symfony console make:controller  


