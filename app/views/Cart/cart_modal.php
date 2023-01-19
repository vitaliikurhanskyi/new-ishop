<div class="modal-body">
    <?php if (!empty($_SESSION['cart'])) : ?>
    <div class="table-responsive cart-table">

        <table class="table text-start">

            <thead>
                <tr>
                    <th scope="col">Фото</th>
                    <th scope="col">Товар</th>
                    <th scope="col">Кол-во</th>
                    <th scope="col">Цена</th>
                </tr>
            </thead>

            <tbody>

                <tr>
                    <td>
                        <a href="#"><img src="<?= PATH ?>/assets/img/products/apple_cinema_30.jpg" alt=""></a>
                    </td>
                    <td><a href="#">Apple cinema</a></td>
                    <td>1</td>
                    <td>100</td>
                </tr>

            </tbody>

        </table>

    </div>
    <?php else : ?>
    <h4 class="text-start">Empty Cart</h4>
    <?php endif; ?>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-danger ripple" data-bs-dismiss="modal">Продолжить покупки</button>
    <?php if (!empty($_SESSION['cart'])) : ?>
        <button type="button" class="btn btn-primary">Оформить заказ</button>
        <button type="button" class="btn btn-danger">Очистить корзину</button>
    <?php endif; ?>
</div>
