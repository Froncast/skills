<section>
    <span class="section_title">Методы верификации</span>
    <table>
    <thead>
        <tr>
            <th scope="col">Метод верификации</th>
            <th scope="col" class="management">Управление</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($vars['ver_m'] as $ver_m): ?>
            <tr>
                <td><?php echo $ver_m['vm_title']; ?></td>
                <td class="management">
                    <button class="btn btn_edit" type="button" value="edit">Edit</button>
                    <button class="btn btn_delete"type="button" value="delete">Delete</button>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</section>