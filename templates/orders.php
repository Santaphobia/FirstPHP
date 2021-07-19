<h2>Заказы</h2>
<?php foreach ($orders as $item):?>
    <div>
        <p>Заказ номер:<?=$item['id']?></p>
        <a href="/order/card/?id=<?=$item['id']?>"><h3><?=$item['status']?></h3></a>
    </div>
<?php endforeach;?>

