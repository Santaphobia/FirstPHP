<h1>Заказ номер: <?=$order->id?></h1>
<p>Имя: <?=$order->name?></p>
<p>Телефон: <?=$order->phone?></p>
<p>Адрес: <?=$order->adress?></p>
<p>Статус: <?=$order->status?></p>
<p>Состав заказа: </p>
<?php foreach (json_decode($order->products) as $item):?>
    <div>
        <h2><?=$item->name?></h2>
        <p>Описание:<?=$item->description?></p>
        <p>К-во:<?=$item->quantity?></p>
        <p>Цена:<?=$item->price*$item->quantity?></p>
    </div>
<?php endforeach;?>
<a href="/order/confirm/?id=<?=$order->id?>">Подтвердить</a>
