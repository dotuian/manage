<tr>
    <td class="center">
        <?php 
            if(in_array('authority/update', $this->authoritys)) {
                echo "<a href='{$this->createUrl('authority/update', array('ID' => $data['ID']))}'>{$data['authority_name']}</a>";
            } else {
                echo $data['authority_name']; 
            }
        ?>
    </td>
    <td class="center"><?php echo isset($category[$data['category']]) ? $category[$data['category']] : '' ; ?></td>
    <td class="center"><?php echo $data['access_path']; ?></td>
</tr>
