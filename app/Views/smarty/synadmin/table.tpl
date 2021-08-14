        <div class="table-responsive">  
            <table class="table mb-0 table-hover  table-striped">
                    
                    <tbody>
                        <?php 
                        print('<thead>
                                    <tr>');
                        foreach ($cols as $key => $col_name) {
                            print('
                                    <th scope="col">'.($key).'</th>
                                    
                            ');
                        }
                        
                        print('</tr>
                                </thead>');
                        
                        foreach ($data as $key => $value) {
                            print('<tr>');
                            foreach ($cols as $key2 => $data_table) {
                                print('<td>'.$value[$data_table].'</td>');
                            }
                            print('</tr>');
                           
                        }
                        ?>
                            
                    </tbody>
            </table>
        </div> 