<section>
    <span class="section_title">Таблица скиллов</span>
    <table>
    <thead>
        <tr>
            <th scope="col">Название скилла</th>
            <th scope="col">Метод верификации</th>
            <th scope="col">Управление</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach($vars['skills'] as $skills):
        ?>
        <tr>
            <td><?php echo $skills['title']; ?></td>
            <td>
            <?php foreach($skills['ver_m'] as $ver_m): ?>
            <?php echo $ver_m['vm_title']; ?>
            <?php  endforeach; ?>
            </td>
            <td class="management">
                <button class="btn btn_edit" type="button" value="edit">Edit</button>
                <button class="btn btn_delete" type="button" value="delete">Delete</button>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</section>