<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Migration extends CI_Migration
{
    public function deploy($table, $fields)
    {
        $src = FCPATH . 'uploads/config/';
        @unlink($src);
        @mkdir($src, 0777);
        $file_name = $src . $table . '.php';
        $content = '';

        foreach ($fields as $field_name => $attrs) {
            $content .= sprintf('$columns[\'%s\'] = new Column($table, \'%s\', \'%s\');' . "\n", $field_name,
                $field_name, $attrs['comment']);
        }
        $content .= "\n";
        foreach ($fields as $field_name => $attrs) {
            $content .= sprintf('$this->form_validation->set_rules(\'%s\', \'%s\', \'trim|required|is_unique[table.field]|min_length[6]|max_length[12]|exact_length[8]|greater_than[8]|less_than[8]|numeric|integer|decimal|valid_email|valid_ip|valid_base64|regex_match[\d{4}-(0[1-9]|1[0-2])-(0[1-9]|1[0-9]|2[0-9]|3(0|1))]\');' .
                "\n", $field_name, $attrs['comment']);
        }
        foreach ($fields as $field_name => $attrs) {
            $content .= sprintf('$data["%s"] = $this->input->post(\'%s\', true);' . "\n", $field_name, $field_name);
        }
        $content .= "\n";
        foreach ($fields as $field_name => $attrs) {
            if (strpos($attrs['type'], 'ENUM') !== false) {
                $type = 'radio';
            } else if (strpos($attrs['type'], 'int') !== false) {
                $type = 'select';
            } else {
                $type = 'input';
            }
            $content .= sprintf("<div class=\"form-group\">
        <?= \$this->form->label('%s',[
            'required' => true
        ]) ?>
        <div class=\"col-lg-8\">
            <div class=\"bs-component\">
                <?= \$this->form->%s('%s') ?>
            </div>
        </div>
    </div>\n", $field_name, $type, $field_name);
        }
        file_put_contents($file_name, $content);
    }
}
