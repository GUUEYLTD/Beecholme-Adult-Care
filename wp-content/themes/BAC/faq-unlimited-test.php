<?php /*Template Name: FAQ-unlimited-test*/
get_header('new');
?>

    <div class="faq">
        <div class="faq-content">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloremque error exercitationem expedita natus officia quaerat tempora tempore! Accusantium adipisci, dolorem, est et eum in incidunt iste molestiae natus nemo nulla omnis qui rem repudiandae sapiente temporibus veritatis. A ad, aliquam consequatur dolores eaque eveniet illo ipsam magnam nemo odit quibusdam quo vitae voluptate. Ad autem, beatae consectetur consequuntur culpa cum delectus est et excepturi id impedit ipsam neque nisi odit, quis. Consequatur id quae quos? Ad dolores eius facilis molestias mollitia, numquam quaerat reprehenderit velit. Aliquam at blanditiis eius hic minima modi, quibusdam. Aliquid fuga molestias quidem quos ratione sapiente!
            Lorem ipsum dLorem ipsum dolor sit amet, consectetur adipisicing elit. Doloremque error exercitationem expedita natus officia quaerat tempora tempore! Accusantium adipisci, dolorem, est et eum in incidunt iste molestiae natus nemo nulla omnis qui rem repudiandae sapiente temporibus veritatis. A ad, aliquam consequatur dolores eaque eveniet illo ipsam magnam nemo odit quibusdam quo vitae voluptate. Ad autem, beatae consectetur consequuntur culpa cum delectus est et excepturi id impedit ipsam neque nisi odit, quis. Consequatur id quae quos? Ad dolores eius facilis molestias mollitia, numquam quaerat reprehenderit velit. Aliquam at blanditiis eius hic minima modi, quibusdam. Aliquid fuga molestias quidem quos ratione sapiente!
            Lorem ipsum dLorem ipsum dolor sit amet, consectetur adipisicing elit. Doloremque error exercitationem expedita natus officia quaerat tempora tempore! Accusantium adipisci, dolorem, est et eum in incidunt iste molestiae natus nemo nulla omnis qui rem repudiandae sapiente temporibus veritatis. A ad, aliquam consequatur dolores eaque eveniet illo ipsam magnam nemo odit quibusdam quo vitae voluptate. Ad autem, beatae consectetur consequuntur culpa cum delectus est et excepturi id impedit ipsam neque nisi odit, quis. Consequatur id quae quos? Ad dolores eius facilis molestias mollitia, numquam quaerat reprehenderit velit. Aliquam at blanditiis eius hic minima modi, quibusdam. Aliquid fuga molestias quidem quos ratione sapiente!
            Lorem ipsum dLorem ipsum dolor sit amet, consectetur adipisicing elit. Doloremque error exercitationem expedita natus officia quaerat tempora tempore! Accusantium adipisci, dolorem, est et eum in incidunt iste molestiae natus nemo nulla omnis qui rem repudiandae sapiente temporibus veritatis. A ad, aliquam consequatur dolores eaque eveniet illo ipsam magnam nemo odit quibusdam quo vitae voluptate. Ad autem, beatae consectetur consequuntur culpa cum delectus est et excepturi id impedit ipsam neque nisi odit, quis. Consequatur id quae quos? Ad dolores eius facilis molestias mollitia, numquam quaerat reprehenderit velit. Aliquam at blanditiis eius hic minima modi, quibusdam. Aliquid fuga molestias quidem quos ratione sapiente!
            Lorem ipsum dLorem ipsum dolor sit amet, consectetur adipisicing elit. Doloremque error exercitationem expedita natus officia quaerat tempora tempore! Accusantium adipisci, dolorem, est et eum in incidunt iste molestiae natus nemo nulla omnis qui rem repudiandae sapiente temporibus veritatis. A ad, aliquam consequatur dolores eaque eveniet illo ipsam magnam nemo odit quibusdam quo vitae voluptate. Ad autem, beatae consectetur consequuntur culpa cum delectus est et excepturi id impedit ipsam neque nisi odit, quis. Consequatur id quae quos? Ad dolores eius facilis molestias mollitia, numquam quaerat reprehenderit velit. Aliquam at blanditiis eius hic minima modi, quibusdam. Aliquid fuga molestias quidem quos ratione sapiente!
            Lorem ipsum dLorem ipsum dolor sit amet, consectetur adipisicing elit. Doloremque error exercitationem expedita natus officia quaerat tempora tempore! Accusantium adipisci, dolorem, est et eum in incidunt iste molestiae natus nemo nulla omnis qui rem repudiandae sapiente temporibus veritatis. A ad, aliquam consequatur dolores eaque eveniet illo ipsam magnam nemo odit quibusdam quo vitae voluptate. Ad autem, beatae consectetur consequuntur culpa cum delectus est et excepturi id impedit ipsam neque nisi odit, quis. Consequatur id quae quos? Ad dolores eius facilis molestias mollitia, numquam quaerat reprehenderit velit. Aliquam at blanditiis eius hic minima modi, quibusdam. Aliquid fuga molestias quidem quos ratione sapiente!
            Lorem ipsum dLorem ipsum dolor sit amet, consectetur adipisicing elit. Doloremque error exercitationem expedita natus officia quaerat tempora tempore! Accusantium adipisci, dolorem, est et eum in incidunt iste molestiae natus nemo nulla omnis qui rem repudiandae sapiente temporibus veritatis. A ad, aliquam consequatur dolores eaque eveniet illo ipsam magnam nemo odit quibusdam quo vitae voluptate. Ad autem, beatae consectetur consequuntur culpa cum delectus est et excepturi id impedit ipsam neque nisi odit, quis. Consequatur id quae quos? Ad dolores eius facilis molestias mollitia, numquam quaerat reprehenderit velit. Aliquam at blanditiis eius hic minima modi, quibusdam. Aliquid fuga molestias quidem quos ratione sapiente!
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloremque error exercitationem expedita natus officia quaerat tempora tempore! Accusantium adipisci, dolorem, est et eum in incidunt iste molestiae natus nemo nulla omnis qui rem repudiandae sapiente temporibus veritatis. A ad, aliquam consequatur dolores eaque eveniet illo ipsam magnam nemo odit quibusdam quo vitae voluptate. Ad autem, beatae consectetur consequuntur culpa cum delectus est et excepturi id impedit ipsam neque nisi odit, quis. Consequatur id quae quos? Ad dolores eius facilis molestias mollitia, numquam quaerat reprehenderit velit. Aliquam at blanditiis eius hic minima modi, quibusdam. Aliquid fuga molestias quidem quos ratione sapiente!
            <?php
            $faq_groups = get_field('group');
            foreach ($faq_groups as $faq_group) : ?>
                <div class="single-topic">
                    <div class="topic d-flex justify-content-between">
                        <div class="name"><?php echo $faq_group['question_type']; ?></div>
                        <div class="arrow"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_up.svg" alt=""></div>
                    </div>
                    <div class="questions-wrapper">
                       
                        <div class="questions">
                            <?php foreach ($faq_group['questionanswer'] as $faq_qstansw) : ?>
                                <div class="question"><?php echo $faq_qstansw['question']; ?></div>
                                <div class="answer"><?php echo $faq_qstansw['answer']; ?></div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>

<?php get_footer('new'); ?>