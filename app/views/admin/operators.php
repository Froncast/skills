<form action="/skills/admin/operators" method="post">
    <input type="text" name="fullname">
    <button type="submit">Enter</button>
</form>
<section>
    <span class="section_title">Список специалистов</span>
    <!-- <iframe src="../admin/operators/edit/1" frameborder="0"></iframe> -->
    <table>
        <thead>
            <tr>
                <th scope="col">ФИО Специалиста</th>
                <th scope="col">Управление</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($vars['operators'] as $operators): ?>
            <tr>
                <td><?php echo $operators['staff_fullname']; ?></td>
                <td class="management">
                    <!-- <button class="btn btn_edit" type="button" value="edit">Edit</button>
                    <button class="btn btn_delete" type="button" value="delete">Delete</button> -->
                    <a href="/skills/admin/operators/edit/<?php echo $operators['id']; ?>" class="btn btn_edit">Редактировать</a>
                    <a href="/skills/admin/operators/delete/<?php echo $operators['id'];?>" class="btn btn_delete">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php echo $pagination; ?>
    <div class="clear" style="clear: both;"></div>
</section>