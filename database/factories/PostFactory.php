<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

   

    public function definition(): array
    {

   $postsFake = [
        [
            "title"=>"Разработка мобильных приложений",
            "description"=>"Процесс создания мобильных приложений",
            "content"=>"<p>Разработка мобильных приложений - это процесс создания программного обеспечения для мобильных устройств, таких как смартфоны и планшеты. Этот процесс включает в себя несколько этапов, начиная от определения требований к приложению и заканчивая его запуском на рынок.</p>
                <p>Первым шагом является определение целевой аудитории и ее потребностей. Затем следует разработка концепции приложения, которая должна быть уникальной и привлекательной для пользователей. После этого начинается работа над дизайном интерфейса, который должен быть интуитивно понятным и удобным в использовании.</p>
                <p>Далее следует этап программирования, который включает в себя написание кода на выбранном языке программирования. Важно учитывать требования операционной системы, на которой будет работать приложение.</p>",
            "img"=>""
        ],
        [
            "title" => "Обзор новых технологий в IT",
            "description" => "Последние тенденции и инновации в IT",
            "content" => "<p>IT-индустрия постоянно развивается и предлагает новые технологии. В этой статье мы рассмотрим последние тенденции и инновации в области информационных технологий.</p>
            <p>Одной из самых популярных технологий является искусственный интеллект (AI). AI используется для автоматизации процессов, улучшения качества продукции и повышения эффективности работы. Кроме того, AI может быть использован для создания новых продуктов и услуг.</p>
            <p>Еще одной важной технологией является блокчейн. Блокчейн - это децентрализованная база данных, которая позволяет хранить информацию без возможности ее изменения или удаления. Блокчейн может быть использован для создания безопасных систем платежей и хранения данных.</p>",
            "img"=>""
        ],
        [
            "title" => "Как выбрать IT-специалиста",
            "description" => "Советы по выбору IT-специалиста",
            "content" => "<p>В современном мире IT-специалисты являются одними из самых востребованных профессий. В этой статье мы рассмотрим, как выбрать IT-специалиста для своей компании.</p>
            <p>Первым шагом является определение требований к кандидату. Необходимо определить, какие навыки и опыт работы необходимы для выполнения задач, которые будут поставлены перед IT-специалистом.</p>
            <p>Далее следует провести анализ рынка труда и определить уровень зарплаты, который будет соответствовать требованиям компании.</p>
            <p>После этого можно начинать поиск кандидатов на вакансию. Для этого можно использовать различные ресурсы, такие как сайты по поиску работы, социальные сети или рекомендации знакомых.</p>",
            "img"=>""
        ],
        [
            "title" => "Облачные вычисления",
            "description" => "Технология облачных вычислений",
            "content" => "<p>Облачные вычисления - это технология, которая позволяет хранить данные на удаленных серверах, что упрощает доступ к ним и повышает безопасность. Эта технология становится все более популярной в современном мире, так как она позволяет экономить время и ресурсы при работе с данными.</p>
            <p>Одним из главных преимуществ облачных вычислений является возможность быстрого масштабирования. Это означает, что при необходимости можно легко увеличить или уменьшить количество ресурсов, используемых для хранения данных. Кроме того, облачные вычисления позволяют снизить затраты на IT-инфраструктуру, так как не требуется приобретать и обслуживать собственное оборудование.</p>
            <p>Еще одним преимуществом облачных вычислений является возможность работы с данными из любой точки мира. Это особенно удобно для компаний, которые имеют филиалы в разных странах или регионах. Кроме того, облачные вычисления обеспечивают высокую степень безопасности данных благодаря использованию шифрования и других методов защиты информации.</p>",
            "img"=>""
        ],
        [
            "title" => "Искусственный интеллект",
"description" => "Технология искусственного интеллекта",
"content" => "<p>Искусственный интеллект (AI) - это область компьютерных наук, которая занимается созданием интеллектуальных систем, способных выполнять задачи, требующие человеческого интеллекта. AI используется для автоматизации процессов, улучшения качества продукции и повышения эффективности работы.</p>
<p>Одной из основных областей применения AI является автоматизация процессов. С помощью AI можно создавать программы, которые будут выполнять рутинные задачи без участия человека. Это позволяет сократить время на выполнение задач и повысить точность результатов.</p>
<p>AI также используется для создания новых продуктов и услуг. Например, с помощью AI можно создавать системы распознавания речи или же системы автоматического перевода текстов. Это позволяет улучшить качество обслуживания клиентов и повысить эффективность работы компании.</p>",
            "img"=>""
        ],
        [
            "title" => "Блокчейн",
"description" => "Технология блокчейна",
"content" => "<p>Блокчейн - это децентрализованная база данных, которая позволяет хранить информацию без возможности ее изменения или удаления. Блокчейн может быть использован для создания безопасных систем платежей и хранения данных.</p>
<p>Основная идея блокчейна заключается в том, что информация хранится в виде цепочки блоков, каждый из которых содержит информацию о предыдущем блоке. Это позволяет создать систему, которая не зависит от центрального сервера и не может быть изменена или удалена без согласия всех участников сети.</p>
<p>Блокчейн может быть использован для создания безопасных систем платежей, таких как криптовалюты. В этом случае каждый блок содержит информацию о транзакции, которая была проведена. Это позволяет создать систему, которая не зависит от центрального сервера и не может быть изменена или удалена без согласия всех участников сети.</p>",
            "img"=>""
        ],
        [
           "title" => "Интернет вещей",
"description" => "Технология интернета вещей",
            "content"=>"<p>Интернет вещей (IoT) - это концепция, которая предполагает подключение устройств к интернету и обмену данными между ними. IoT позволяет устройствам обмениваться данными между собой и с другими системами.</p>
<p>Основная идея IoT заключается в том, что устройства могут быть подключены к интернету и обмениваться данными друг с другом. Это позволяет создавать умные дома, умные города и другие инновационные решения. Например, с помощью IoT можно создать систему управления освещением в доме, которая будет автоматически включать и выключать свет в зависимости от присутствия людей в комнате.</p>
<p>IoT также может быть использован для создания систем безопасности. Например, с помощью IoT можно создать систему видеонаблюдения, которая будет автоматически распознавать лица или же обнаруживать подозрительную активность на территории объекта.</p>",
            "img"=>""
        ],
        [
           "title" => "Big Data",
"description" => "Технология Big Data",
            "content"=>"<p>Big Data - это большие объемы данных, которые могут быть использованы для анализа и принятия решений. Big Data позволяет компаниям собирать и анализировать данные о своих клиентах, продуктах и процессах, чтобы улучшить качество обслуживания и повысить эффективность работы.</p>
<p>Основная идея Big Data заключается в том, что компании могут собирать и анализировать большие объемы данных, чтобы получить ценную информацию о своих клиентах, продуктах и процессах. Это позволяет компаниям принимать более обоснованные решения и улучшать качество обслуживания клиентов.</p>",
            "img"=>""
        ],
        [
            "title" => "Кибербезопасность",
"description" => "Технология кибербезопасности",
            "content"=>"<p>Кибербезопасность - это защита компьютерных систем от несанкционированного доступа, изменения или уничтожения данных. Кибербезопасность является важной составляющей любой компании, так как она позволяет защитить конфиденциальную информацию и предотвратить возможные кибератаки.</p>
<p>Основная идея кибербезопасности заключается в том, чтобы защитить компьютерные системы от несанкционированного доступа, изменения или уничтожения данных. Для этого используются различные методы и технологии, такие как шифрование данных, антивирусные программы, брандмауэры и другие.</p>
<p>Кибербезопасность может быть использована для защиты конфиденциальной информации компании. Например, с помощью кибербезопасности можно защитить данные клиентов, финансовую информацию и другие конфиденциальные данные от несанкционированного доступа.</p>",
            "img"=>""
        ],
        [
            "title" => "Робототехника",
"description" => "Технология робототехники",
            "content"=>"<p>Робототехника - это область науки и техники, которая занимается созданием и использованием роботов для автоматизации процессов. Роботы могут быть использованы в различных отраслях, таких как производство, медицина, строительство и другие.</p>
<p>Основная идея робототехники заключается в том, чтобы создать роботов, которые могут выполнять рутинные задачи без участия человека. Это позволяет сократить время на выполнение задач и повысить точность результатов. Кроме того, роботы могут быть использованы для выполнения опасных или сложных задач, которые человек не может выполнить.</p>
<p>Робототехника может быть использована для создания роботов-манипуляторов, которые могут выполнять различные задачи на производстве. Например, робот-манипулятор может собирать автомобили или производить другие товары.</p>",
            "img"=>""
        ],
        [
            "title" => "Технологии виртуальной реальности",
"description" => "Основы виртуальной реальности",
            "content"=>"<p>Технологии виртуальной реальности (VR) позволяют создавать виртуальные миры и погружаться в них с помощью специальных устройств. VR используется в различных отраслях, таких как игры, образование, медицина и другие.</p>
<p>Основная идея VR заключается в том, чтобы создать виртуальный мир, который будет максимально приближен к реальному. Для этого используются различные методы и технологии, такие как 3D-графика, звуковые эффекты и другие.</p>
<p>VR может быть использована для создания игр и развлечений. Например, с помощью VR можно создать игру, которая будет полностью погружать игрока в виртуальный мир. Это позволяет получить новые ощущения и эмоции.</p>",
            "img"=>""
        ],
    ];
    $i = rand(0, 9);
          return [
            'user_id' =>  rand(1, 19),
            'photo' => rand(1, 15).'.jpg',
            'title' => $postsFake[$i]['title'],
            'content' => $postsFake[ $i]['content'],
            'description' => $postsFake[ $i]['description'],
            'delay' => fake()->dateTimeBetween('-1 week', '+1 week'),
            'draft' => fake()->randomElement([0,1],),
  
        ];
    }
}
