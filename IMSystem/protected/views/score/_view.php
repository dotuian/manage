<tr>
    <td class="center"><?php echo $data['exam_name'] ; ?></td>
    <td class="center"><?php echo $data['class_name']; ?></td>
    <td class="center"><?php echo $data['subject_name'] ; ?></td>
    <td class="center"><?php echo $data['student_number']; ?></td>
    <td class="center"><?php echo $data['name']; ?></td>
    <td class="center"><?php echo $data['score'] ; ?></td>
    
    <td class="center">
        <a href="<?php echo $this->createUrl('score/update', array('ID' => $data['ID'])) ?>">详细</a>
    </td>
</tr>
