<tr>
    <td class="center"><?php echo $data['authority_name']; ?></td>
    <td class="center"><?php echo isset($category[$data['category']]) ? $category[$data['category']] : '' ; ?></td>
    <td class="center"><?php echo $data['access_path']; ?></td>
    <td class="center">
        <a href="<?php echo $this->createUrl('authority/update', array('ID' => $data['ID'])) ?>">详细</a>
    </td>
</tr>
