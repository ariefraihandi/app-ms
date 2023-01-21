<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">   
                
            <?php
                $this->load->view('Index/adminsidebar');
            ?>   

            <div class="layout-page">    

                <?php
                    $this->load->view('Index/adminnavbar');
                ?>
                
                <?php
                    $this->load->view('Index/adminkonten');
                ?>

                <div class="content-wrapper">                    
                    
                    <?php
                        $this->load->view('Index/adminfooter');
                    ?>
                    <div class="content-backdrop fade"></div>
                </div>                                        
            </div>
        </div>
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>

        <?php
            $this->load->view('Index/adminscript');
        ?>
</body>
</html>


   

            
           