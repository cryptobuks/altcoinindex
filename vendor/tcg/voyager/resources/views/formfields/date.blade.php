<input type="date" class="form-control" name="{{ $row->field }}"
       placeholder="{{ $row->display_name }}"
       value="@if(isset($dataTypeContent->{$row->field})){{ gmdate('Y-m-d', strtotime(old($row->field, $dataTypeContent->{$row->field}))) }}@else{{old($row->field)}}@endif">
