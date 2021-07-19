<h2>Корзина</h2>

<?php if(empty($products)):?>
    <p>Корзина пуста</p>
<?php else:?>
    <div id="basket">
    <?php foreach ($products as $item):?>
        <div id="<?= $item['id_basket']?>">
            <h2><?=$item['name']?></h2>
            <p>Описание:<?=$item['description']?></p>
            <p id="countProduct<?= $item['id_basket']?>">К-во:<?=$item['quantity']?></p>
            <p id="priceProduct<?= $item['id_basket']?>">Цена:<?=$item['price']*$item['quantity']?></p>
            <button data-id="<?= $item['id_basket']?>" class="delete">Удалить</button>
            <hr>
        </div>
    <?php endforeach;?>
    </div>
    <form id="reg_form" name="form">
        <label> Введите ваше имя:
            <input type="text" name="order_name" placeholder="Ваше имя"" required>
        </label>
        <label>Введите ваш телефон:
            <input type="text" name="order_phone" placeholder="Ваш телефон" required>
        </label>
        <label>Введите ваш адрес:
            <input type="text" name="order_adress" placeholder="Ваш адрес" required>
        </label>
        <button id="button_order">Подтвердить</button>
    </form>
<?php endif;?>


<script>
    let buttons = document.querySelectorAll('.delete');
    buttons.forEach((elem) => {
        elem.addEventListener('click', () => {
            let id = elem.getAttribute('data-id');
            (
                async () => {
                    const response = await fetch('/basket/delete/', {
                        method: 'POST',
                        headers: new Headers({
                            'Content-Type': 'application/json'
                        }),
                        body: JSON.stringify({
                            id: id,
                        })
                    });
                    const answer = await response.json();
                    document.getElementById('count').innerText = answer.count;
                    if (answer.quantity == 0) {
                        document.getElementById(id).remove();
                    } else {
                        document.getElementById(`countProduct${id}`).innerText =`К-во:${answer.quantity}`;
                        document.getElementById(`priceProduct${id}`).innerText =`Цена:${answer.quantity * answer.price}`;
                    }
                    if (answer.count == 0) {
                        document.getElementById('reg_form').remove();
                        let $text = document.createElement('p');
                        $text.innerText = 'Корзина пуста';
                        let $body = document.getElementsByTagName('body')[0];
                        $body.insertAdjacentElement('beforeend', $text);
                    }
                }
            )();
        })
    });
    let button = document.getElementById('button_order');
    button.addEventListener('click', (event) => {
        event.preventDefault();
        let form = document.forms.form;
        (
            async () => {
                const response = await fetch('/order/addOrder/', {
                    method: 'POST',
                    headers: new Headers({
                        'Content-Type': 'application/json'
                    }),
                    body: JSON.stringify({
                        order_name: form.elements.order_name.value,
                        order_phone: form.elements.order_phone.value,
                        order_adress: form.elements.order_adress.value
                    })
                });
                const answer = await response.json();
                document.getElementById('count').innerText = answer.count;
                document.getElementById('reg_form').remove();
                document.getElementById('basket').remove();
                let $text = document.createElement('p');
                $text.innerText = `Заказ сформирован. Номер вашего заказа: ${answer.order_id}`;
                let $body = document.getElementsByTagName('body')[0];
                $body.insertAdjacentElement('beforeend', $text);
            }
        )();
    })
</script>
