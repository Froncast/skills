<section>
    <span class="section_title">Администраторы</span>
    <table>
        <thead>
            <tr>
                <th scope="col">ФИО Администратора</th>
                <th scope="col">Почта</th>
                <th scope="col">Логин</th>
                <th scope="col">Управление</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($vars['admin_list'] as $admin_list) : ?>
            <tr>
                <td>
                    <?php echo $admin_list['fullname']; ?>
                </td>
                <td>
                    <?php echo $admin_list['email']; ?>
                </td>
                <td>
                    <?php echo $admin_list['login']; ?>
                </td>
                <td class="management">
                    <button class="btn btn_edit" type="button" value="edit">Edit</button>
                    <button class="btn btn_delete"type="button" value="delete">Delete</button>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>