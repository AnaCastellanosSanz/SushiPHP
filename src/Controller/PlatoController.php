<?php

namespace App\Controller;

use App\Entity\Plato;
use App\Entity\Ingrediente;
use App\Form\PlatoType;
use App\Manager\PlatoManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use App\Form\SearcherType;

class PlatoController extends AbstractController{




    #[Route("/sushi", name:"api_sushi")]
   public function getSushiData(): Response
   {
       // Hace una solicitud GET a la URL de la API
       $sushiData = file_get_contents('https://640b62cf81d8a32198e2dbe8.mockapi.io/sushi');
       
       // Convierte los datos en un array asociativo
       $sushiArray = json_decode($sushiData, true);
       
       // Renderiza los datos en una plantilla Twig o devuelve una respuesta HTTP con los datos
       return $this->render('platos/sushi.html.twig', [
           'sushi_data' => $sushiArray,
       ]);
   }


    #[Route("/inicio", name:"inicio")]
        public function inicio(){

    return $this -> render("platos/inicio.html.twig");
    }

    #[Route("/sushi", name:"sushiDiario")]
        public function diario(){

    return $this -> render("platos/sushi.html.twig");
    }

    #[Route('/plato/{id}', name:'showPlato')]
    public function showPlato(EntityManagerInterface $doctrine, $id){
        $repositorio=$doctrine->getRepository(Plato::class);
        $plato=$repositorio->find($id);
        return $this->render('platos/showPlato.html.twig', ['plato'=> $plato]);
    }
    
    #[Route('/platos' , name:'listPlatos')]
    public function listPlatos(EntityManagerInterface $doctrine,Request $request){
        $form = $this-> createForm(SearcherType::class);
        $form-> handleRequest($request);
        if ($form-> isSubmitted() && $form-> isValid()) {
            $plato = $form-> get('plato')->getData();
            return $this->redirectToRoute('showPlato', ['id'=>$plato->getId()]);
        }

        $repositorio=$doctrine->getRepository(Plato::class);
        $platos=$repositorio->findAll();
        return $this->render('platos/listPlatos.html.twig', ['platos' => $platos, 'searchForm'=>$form]);
    }


    #[Route('/new/plato')]
    public function newPlato(EntityManagerInterface $doctrine){
       $plato1= new Plato();
       $plato1->setNombre("Samón Lover");
       $plato1->setDescripcion("Para los amantes del salmón, 40 piezas de uramaki y maki.");
       $plato1->setImagen("https://cdn.pixabay.com/photo/2020/03/22/08/43/sushi-4956246_1280.jpg");
       $plato1->setPrecio(50);

       $plato2= new Plato();
       $plato2->setNombre("Uramaki pollo");
       $plato2->setDescripcion("Uramaki de pollo envuelto en una capa de salmón.");
       $plato2->setImagen("https://cdn.pixabay.com/photo/2017/10/15/11/41/sushi-2853382_1280.jpg");
       $plato2->setPrecio(12);

       $plato3= new Plato();
       $plato3->setNombre("Uramaki alga");
       $plato3->setDescripcion("Uramaki de salmón y queso crema, envuelto en wakame.");
       $plato3->setImagen("https://cdn.pixabay.com/photo/2017/10/16/09/00/sushi-2856544_1280.jpg");
       $plato3->setPrecio(12);

       $plato4= new Plato();
       $plato4->setNombre("Nigiri anguila");
       $plato4->setDescripcion("Niguiri de anguila flambeada recubierto de salsa anguila.");
       $plato4->setImagen("https://cdn.pixabay.com/photo/2017/08/05/13/55/sushi-2583775_1280.jpg");
       $plato4->setPrecio(5);

       $plato5= new Plato();
       $plato5->setNombre("Maki mantequilla");
       $plato5->setDescripcion("Maki de pez mantequilla envuelto en alga nori.");
       $plato5->setImagen("https://cdn.pixabay.com/photo/2020/07/21/08/41/sushi-5425611_1280.jpg");
       $plato5->setPrecio(6);

       $plato6= new Plato();
       $plato6->setNombre("Combo barco sushi");
       $plato6->setDescripcion("40 piezas de sushi de anguila, pez mantequilla, atún y salmón.");
       $plato6->setImagen("https://cdn.pixabay.com/photo/2019/06/16/19/37/sushi-4278583_1280.jpg");
       $plato6->setPrecio(45);

       $plato7= new Plato();
       $plato7->setNombre("Sashimi");
       $plato7->setDescripcion("Mix sashimi de salmón, atún y peza mantequilla.");
       $plato7->setImagen("https://cdn.pixabay.com/photo/2019/04/23/13/22/sushi-4149521_1280.jpg");
       $plato7->setPrecio(6);

       $plato8= new Plato();
       $plato8->setNombre("Uramaki salmón");
       $plato8->setDescripcion("Uramaki de salmón con salsa de anguila y mango.");
       $plato8->setImagen("https://cdn.pixabay.com/photo/2020/04/19/09/48/sushi-5062748_1280.jpg");
       $plato8->setPrecio(12);

       $plato9= new Plato();
       $plato9->setNombre("Sopa miso");
       $plato9->setDescripcion("Sopa miso con alga nori, caldo dashi y pasta de miso.");
       $plato9->setImagen("https://cdn.pixabay.com/photo/2023/01/10/08/14/new-year-dishes-7709210_1280.jpg");
       $plato9->setPrecio(5);

       $plato10= new Plato();
       $plato10->setNombre("Niguiri salmón flambeado");
       $plato10->setDescripcion("Niguiri de salmón flambeado con alga nori recubierta de oro.");
       $plato10->setImagen("https://cdn.pixabay.com/photo/2019/10/22/02/04/sushi-4567448_1280.jpg");
       $plato10->setPrecio(5);

       $plato11= new Plato();
       $plato11->setNombre("Maki de anguila");
       $plato11->setDescripcion("Maki de anguila y aguacate recubierto de alga nori.");
       $plato11->setImagen("https://cdn.pixabay.com/photo/2021/02/08/07/38/food-5993942_1280.jpg");
       $plato11->setPrecio(6);

       $plato12= new Plato();
       $plato12->setNombre("Uramaki de atún");
       $plato12->setDescripcion("Uramaki de atún, aguacate y cebolla frita.");
       $plato12->setImagen("https://cdn.pixabay.com/photo/2018/10/05/00/18/sushi-3724827_1280.jpg");
       $plato12->setPrecio(14);

       $plato13= new Plato();
       $plato13->setNombre("Bandeja Mix");
       $plato13->setDescripcion("Bandeja de 40 piezas de sushi vegetal, salmón y atún.");
       $plato13->setImagen("https://cdn.pixabay.com/photo/2020/04/04/15/07/sushi-5002639_1280.jpg");
       $plato13->setPrecio(50);

       $plato14= new Plato();
       $plato14->setNombre("Maki de salmón");
       $plato14->setDescripcion("Uramaki de salmón cubierto de aguacate.");
       $plato14->setImagen("https://cdn.pixabay.com/photo/2017/06/04/03/41/sushi-2370272_1280.jpg");
       $plato14->setPrecio(6);

       $plato15= new Plato();
       $plato15->setNombre("Uramaki de Aguacate");
       $plato15->setDescripcion("Uramaki de atún, aguacate y cebolla frita.");
       $plato15->setImagen("https://cdn.pixabay.com/photo/2017/06/04/03/37/sushi-2370265_1280.jpg");
       $plato15->setPrecio(13);

       $plato16= new Plato();
       $plato16->setNombre("Sushi deluxe");
       $plato16->setDescripcion("Sushi deluxe de atún, pez mantequilla, anguila y huevas.");
       $plato16->setImagen("https://cdn.pixabay.com/photo/2017/02/23/06/44/tokyo-2091357_1280.jpg");
       $plato16->setPrecio(25);

       $plato17= new Plato();
       $plato17->setNombre("Niguiri mantequilla");
       $plato17->setDescripcion("Niguiri de pez mantequilla flambeado.");
       $plato17->setImagen("https://cdn.pixabay.com/photo/2015/09/09/19/46/sushi-932868_1280.jpg");
       $plato17->setPrecio(5);

       $plato18= new Plato();
       $plato18->setNombre("Niguiri atún");
       $plato18->setDescripcion("Niguiri de atún frambeado con salsa mayo.");
       $plato18->setImagen("https://cdn.pixabay.com/photo/2015/09/23/15/54/sushi-953933_1280.jpg");
       $plato18->setPrecio(5);

       $plato19= new Plato();
       $plato19->setNombre("Uramaki camarón");
       $plato19->setDescripcion("Uramaki de arroz morado, alga nori y camarón.");
       $plato19->setImagen("https://cdn.pixabay.com/photo/2022/08/08/14/31/sushi-7372851_1280.jpg");
       $plato19->setPrecio(15);

       $plato20= new Plato();
       $plato20->setNombre("Niguiri salmón");
       $plato20->setDescripcion("Niguiri de salmón");
       $plato20->setImagen("https://www.japonalternativo.com/wp-content/uploads/2020/04/como-se-hace-el-sushi-nigiri.jpg");
       $plato20->setPrecio(5);

       $plato21= new Plato();
       $plato21->setNombre("Sake");
       $plato21->setDescripcion("Kit de sake en cerámica tradicional.");
       $plato21->setImagen("https://cdn.pixabay.com/photo/2016/08/25/03/05/japans-1618638_1280.jpg");
       $plato21->setPrecio(8);

       $plato22= new Plato();
       $plato22->setNombre("Bandeja sushi");
       $plato22->setDescripcion("Bandeja de 24 piezas de sushi de salmón.");
       $plato22->setImagen("https://cdn.pixabay.com/photo/2021/03/02/20/04/sushi-6063707_1280.jpg");
       $plato22->setPrecio(30);

       $plato23= new Plato();
       $plato23->setNombre("Uramaki de atún");
       $plato23->setDescripcion("Uramaki de atún y anguila recubierto de salmón.");
       $plato23->setImagen("https://cdn.pixabay.com/photo/2020/04/19/09/48/sushi-5062750_1280.jpg");
       $plato23->setPrecio(5);

       $plato24= new Plato();
       $plato24->setNombre("Uramaki Deluxe");
       $plato24->setDescripcion("Uramaki Deluxe, con mango, salmón y pez mantequilla.");
       $plato24->setImagen("https://cdn.pixabay.com/photo/2020/04/20/07/28/japan-food-5066737_1280.jpg");
       $plato24->setPrecio(15);





       $ingrediente1 = new Ingrediente();
       $ingrediente1-> setNombre("salmon");
       
       $ingrediente2 = new Ingrediente();
       $ingrediente2-> setNombre("atún");

       $ingrediente3 = new Ingrediente();
       $ingrediente3-> setNombre("pez mantequilla");

       $ingrediente4 = new Ingrediente();
       $ingrediente4-> setNombre("mango");
       
       $ingrediente5 = new Ingrediente();
       $ingrediente5-> setNombre("aguacate");

       $ingrediente6 = new Ingrediente();
       $ingrediente6-> setNombre("salsa de anguila");

       $ingrediente7 = new Ingrediente();
       $ingrediente7-> setNombre("salsa de soja");

       $ingrediente8 = new Ingrediente();
       $ingrediente8-> setNombre("cebolla frita");

       $ingrediente9 = new Ingrediente();
       $ingrediente9-> setNombre("salsa mayo");

       $ingrediente10 = new Ingrediente();
       $ingrediente10-> setNombre("alga nori");

       $ingrediente11 = new Ingrediente();
       $ingrediente11-> setNombre("pollo");

       $ingrediente12 = new Ingrediente();
       $ingrediente12-> setNombre("wakame");

       $ingrediente13 = new Ingrediente();
       $ingrediente13-> setNombre("queso crema");

       $ingrediente14 = new Ingrediente();
       $ingrediente14-> setNombre("anguila");

       $ingrediente15 = new Ingrediente();
       $ingrediente15-> setNombre("pasta de miso");

       $ingrediente16 = new Ingrediente();
       $ingrediente16-> setNombre("caldo dashi");

       $ingrediente17 = new Ingrediente();
       $ingrediente17-> setNombre("huevas");

       $ingrediente18 = new Ingrediente();
       $ingrediente18-> setNombre("arroz morado");

       $ingrediente19 = new Ingrediente();
       $ingrediente19-> setNombre("camarón");

       $ingrediente20 = new Ingrediente();
       $ingrediente20-> setNombre("sake");




       
    //Salmon Lover
       $plato1 -> addIngrediente($ingrediente1);
       $plato1 -> addIngrediente($ingrediente6);

       //Uramaki pollo
       $plato2 -> addIngrediente($ingrediente1);
       $plato2 -> addIngrediente($ingrediente11);
       $plato2 -> addIngrediente($ingrediente5);
       $plato2 -> addIngrediente($ingrediente13);

       //Uramaki alga
       $plato3 -> addIngrediente($ingrediente1);
       $plato3 -> addIngrediente($ingrediente13);
       $plato3 -> addIngrediente($ingrediente12);

       //Nigiri anguila
       $plato4 -> addIngrediente($ingrediente14);
       $plato4 -> addIngrediente($ingrediente6);

       //Maki mantequilla
       $plato5 -> addIngrediente($ingrediente3);
       $plato5 -> addIngrediente($ingrediente10);

       //Combo barco sushi
       $plato6 -> addIngrediente($ingrediente1);
       $plato6 -> addIngrediente($ingrediente2);
       $plato6 -> addIngrediente($ingrediente3);
       $plato6 -> addIngrediente($ingrediente14);
       $plato6 -> addIngrediente($ingrediente10);

       //Sashimi
       $plato7 -> addIngrediente($ingrediente1);
       $plato7 -> addIngrediente($ingrediente2);
       $plato7 -> addIngrediente($ingrediente3);
       
       //Uramaki salmón
       $plato8 -> addIngrediente($ingrediente1);
       $plato8 -> addIngrediente($ingrediente4);
       $plato8 -> addIngrediente($ingrediente6);

       //Sopa miso
       $plato9 -> addIngrediente($ingrediente10);
       $plato9 -> addIngrediente($ingrediente15);
       $plato9 -> addIngrediente($ingrediente16);

       //Niguiri salmón flambeado
       $plato10 -> addIngrediente($ingrediente1);
       $plato10 -> addIngrediente($ingrediente10);

       //Maki de anguila y aguacate
       $plato11 -> addIngrediente($ingrediente14);
       $plato11 -> addIngrediente($ingrediente10);
       $plato11 -> addIngrediente($ingrediente5);

       //Uramaki de atún
       $plato12 -> addIngrediente($ingrediente2);
       $plato12 -> addIngrediente($ingrediente5);
       $plato12 -> addIngrediente($ingrediente8);

       //Bandeja Mix
       $plato13 -> addIngrediente($ingrediente1);
       $plato13 -> addIngrediente($ingrediente2);
       $plato13 -> addIngrediente($ingrediente5);
       $plato13 -> addIngrediente($ingrediente10);

       //Maki de salmón
       $plato14 -> addIngrediente($ingrediente1);
       $plato14 -> addIngrediente($ingrediente10);

       //Uramaki de Aguacate
       $plato15 -> addIngrediente($ingrediente1);
       $plato15 -> addIngrediente($ingrediente5);

       //Sushi deluxe
       $plato16 -> addIngrediente($ingrediente2); 
       $plato16 -> addIngrediente($ingrediente3);
       $plato16 -> addIngrediente($ingrediente14);
       $plato16 -> addIngrediente($ingrediente17);

       //Niguiri mantequilla 
       $plato17 -> addIngrediente($ingrediente3);

        //Niguiri atún 
        $plato18 -> addIngrediente($ingrediente2);

        //Uramaki camarón 
        $plato19 -> addIngrediente($ingrediente18);
        $plato19 -> addIngrediente($ingrediente19);
        $plato19 -> addIngrediente($ingrediente10);

        //Niguiri salmón 
        $plato20 -> addIngrediente($ingrediente1);

        //Niguiri salmón 
        $plato21 -> addIngrediente($ingrediente20);

        //Bandeja sushi
        $plato22 -> addIngrediente($ingrediente1);
        $plato22 -> addIngrediente($ingrediente5);
        $plato22 -> addIngrediente($ingrediente13);

        //Uramaki de atún
        $plato23 -> addIngrediente($ingrediente2);
        $plato23 -> addIngrediente($ingrediente5);
        $plato23 -> addIngrediente($ingrediente14);
        $plato23 -> addIngrediente($ingrediente9);

        //Uramaki deluxe
        $plato24 -> addIngrediente($ingrediente1);
        $plato24 -> addIngrediente($ingrediente2);
        $plato24 -> addIngrediente($ingrediente3);
        $plato24 -> addIngrediente($ingrediente5);

        






       $doctrine->persist($plato1);
       $doctrine->persist($plato2);
       $doctrine->persist($plato3);
       $doctrine->persist($plato4);
       $doctrine->persist($plato5);
       $doctrine->persist($plato6);
       $doctrine->persist($plato7);
       $doctrine->persist($plato8);
       $doctrine->persist($plato9);
       $doctrine->persist($plato10);
       $doctrine->persist($plato11);
       $doctrine->persist($plato12);
       $doctrine->persist($plato13);
       $doctrine->persist($plato14);
       $doctrine->persist($plato15);
       $doctrine->persist($plato16);
       $doctrine->persist($plato17);
       $doctrine->persist($plato18);
       $doctrine->persist($plato19);
       $doctrine->persist($plato20);
       $doctrine->persist($plato21);
       $doctrine->persist($plato22);
       $doctrine->persist($plato23);
       $doctrine->persist($plato24);
  

       $doctrine->persist($ingrediente1);
       $doctrine->persist($ingrediente2);
       $doctrine->persist($ingrediente3);
       $doctrine->persist($ingrediente4);
       $doctrine->persist($ingrediente5);
       $doctrine->persist($ingrediente6);
       $doctrine->persist($ingrediente7);
       $doctrine->persist($ingrediente8);
       $doctrine->persist($ingrediente9);
       $doctrine->persist($ingrediente10);
       $doctrine->persist($ingrediente11);
       $doctrine->persist($ingrediente12);
       $doctrine->persist($ingrediente13);
       $doctrine->persist($ingrediente14);
       $doctrine->persist($ingrediente15);
       $doctrine->persist($ingrediente16);
       $doctrine->persist($ingrediente17);
       $doctrine->persist($ingrediente18);
       $doctrine->persist($ingrediente19);
       $doctrine->persist($ingrediente20);



       $doctrine->flush();
       return new Response("Platos insertados correctamente");
    }
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/insert/plato', name: 'insertPlato')]
    public function insertPlato(Request $request, EntityManagerInterface $doctrine, PlatoManager $manager) {
        $form = $this-> createForm(PlatoType::class);
        $form-> handleRequest($request);
        if ($form-> isSubmitted() && $form-> isValid()) {
            $plato = $form-> getData();
            $platoImage = $form->get('imagenPlato') -> getData();
            if ($platoImage){
                $platoImage = $manager -> load($platoImage, $this->getParameter('kernel.project_dir').'/public/asset/image' );
                $plato -> setImagen('/asset/image/'.$platoImage);
            }

            $doctrine-> persist($plato);
            $doctrine-> flush();
            $this-> addFlash('success', 'Plato insertado correctamente');
            return $this-> redirectToRoute('listPlatos');
        }
        return $this-> renderForm('platos/createPlato.html.twig', [
            'platoForm'=> $form
        ]);
    } 
    #[IsGranted('ROLE_ADMIN')] 
    #[Route('/edit/plato/{id}', name: 'editPlato')]
    public function editPlato(Request $request, EntityManagerInterface $doctrine ,$id) {   $repositorio=$doctrine->getRepository(Plato::class);
        $plato=$repositorio->find($id);


        $form = $this-> createForm(PlatoType::class, $plato);
        $form-> handleRequest($request);
        if ($form-> isSubmitted() && $form-> isValid()) {
            $plato = $form-> getData();
            $platoImage = $form->get('imagenPlato')->getData();
            if ($platoImage){

            }
            $doctrine-> persist($plato);
            $doctrine-> flush();
            $this-> addFlash('success', 'Plato editado correctamente');
            return $this-> redirectToRoute('listPlatos');
        }
        return $this-> renderForm('platos/createPlato.html.twig', [
            'platoForm'=> $form
        ]);
    }
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/delete/plato/{id}', name:'deletePlato')]
    public function deletePlato(EntityManagerInterface $doctrine, $id){
        $repositorio=$doctrine->getRepository(Plato::class);
        $plato=$repositorio->find($id);
        $doctrine->remove($plato);
        $doctrine->flush();
        $this->addFlash('success', 'Plato eliminado correctamente');
        return $this->redirectToRoute('listPlatos');
    }  
}

