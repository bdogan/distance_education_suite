<?php
/**
 * @var \BackOffice\View\BackOfficeView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $classRooms
 */
?>
<div class="row bo-index classRooms">
    <div class="col-12 mb-2">
        <div class="row">
            <h4 class="col-6 bo-index-title"><?= $this->BackOffice->icon('view_list', 'md-26') ?> Sınıf Listesi</h4>
            <div class="col-6 bo-index-actions text-right">
                <?= $this->Html->link($this->BackOffice->icon('add_box', 'md-18 mr-1') . 'Yeni Sınıf', ['action' => 'add'], ['class' => 'btn btn-primary', 'escape' => false]) ?>
            </div>
        </div>
    </div>
    <div class="col-12 mb-3">
        <!--<svg xmlns="http://www.w3.org/2000/svg" id="fda871d6-4a4f-49fc-88be-f761f3bd5c82" data-name="Layer 1" width="965.3527" height="690.00277" viewBox="0 0 965.3527 690.00277" class="injected-svg modal__media modal__lg_media" data-src="https://42f2671d685f51e10fc6-b9fcecea3e50b3b59bdc28dead054ebc.ssl.cf5.rackcdn.com/illustrations/online_page_cq94.svg" xmlns:xlink="http://www.w3.org/1999/xlink"><title>online page</title><path d="M220.67635,681.31878c0,38.91826-23.13629,52.50707-51.67635,52.50707s-51.67635-13.58881-51.67635-52.50707S169,592.89034,169,592.89034,220.67635,642.40051,220.67635,681.31878Z" transform="translate(-117.32365 -104.99861)" fill="#f2f2f2"></path><polygon points="49.794 622.874 50.323 590.303 72.349 550.008 50.406 585.193 50.644 570.548 65.824 541.395 50.707 566.672 50.707 566.673 51.135 540.332 67.39 517.123 51.202 536.19 51.469 487.892 49.789 551.83 49.927 549.193 33.401 523.896 49.662 554.256 48.122 583.674 48.077 582.893 29.024 556.272 48.019 585.651 47.826 589.33 47.792 589.385 47.808 589.687 43.901 664.322 49.121 664.322 49.747 625.772 68.695 596.464 49.794 622.874" fill="#3f3d56"></polygon><path d="M628.11946,181.26363c135.67422,108.10875,158.02045,305.73388,49.91171,441.4081s-437.3685,223.34374-441.4081,49.91171c-4.0655-174.54282-93.88069-338.11066-49.91171-441.4081C254.6545,71.5548,492.44524,73.15489,628.11946,181.26363Z" transform="translate(-117.32365 -104.99861)" fill="#f2f2f2"></path><ellipse cx="150.3527" cy="666.00277" rx="144" ry="24" fill="#3f3d56"></ellipse><ellipse cx="886.76232" cy="657.95576" rx="70.91403" ry="11.819" fill="#3f3d56"></ellipse><rect x="143.3527" y="160.00277" width="822" height="444" fill="#3f3d56"></rect><rect x="143.3527" y="124.00277" width="822" height="41" fill="#3f3d56"></rect><circle cx="163.3527" cy="142.00277" r="7" fill="#6c63ff"></circle><circle cx="183.3527" cy="142.00277" r="7" fill="#6c63ff"></circle><circle cx="203.3527" cy="142.00277" r="7" fill="#6c63ff"></circle><rect x="143.3527" y="160.00277" width="822" height="5" opacity="0.1"></rect><rect x="190.8527" y="230.50277" width="162" height="173" fill="#6c63ff" opacity="0.3"></rect><rect x="201.8527" y="218.50277" width="162" height="173" fill="#6c63ff"></rect><rect x="784.8527" y="227.7282" width="124.54335" height="133" fill="#6c63ff" opacity="0.3"></rect><rect x="793.30935" y="218.50277" width="124.54335" height="133" fill="#6c63ff"></rect><rect x="784.8527" y="412.50277" width="124.54335" height="133" fill="#6c63ff" opacity="0.3"></rect><rect x="793.30935" y="403.27734" width="124.54335" height="133" fill="#6c63ff"></rect><rect x="420.8527" y="218.50277" width="309" height="12" fill="#6c63ff"></rect><rect x="420.8527" y="253.50277" width="309" height="12" fill="#6c63ff"></rect><rect x="420.8527" y="288.50277" width="309" height="12" fill="#6c63ff"></rect><rect x="420.8527" y="323.50277" width="309" height="12" fill="#6c63ff"></rect><rect x="420.8527" y="358.50277" width="309" height="12" fill="#6c63ff"></rect><rect x="420.8527" y="393.50277" width="309" height="12" fill="#6c63ff"></rect><rect x="420.8527" y="428.50277" width="309" height="12" fill="#6c63ff"></rect><rect x="420.8527" y="463.50277" width="309" height="12" fill="#6c63ff"></rect><rect x="420.8527" y="498.50277" width="309" height="12" fill="#6c63ff"></rect><rect x="420.8527" y="533.50277" width="309" height="12" fill="#6c63ff"></rect><circle cx="126.33911" cy="291.38169" r="21.50008" fill="#a0616a"></circle><path d="M229.75094,406.498s0,22.7648-3.79413,25.29422,30.35305,5.05884,30.35305,5.05884V407.76271Z" transform="translate(-117.32365 -104.99861)" fill="#a0616a"></path><path d="M188.01548,532.96907S212.045,560.7927,217.10383,560.7927,227.22152,541.822,227.22152,541.822l-24.02951-17.706Z" transform="translate(-117.32365 -104.99861)" fill="#a0616a"></path><path d="M308.163,407.76271l3.79413-26.55893s2.52943-36.67661,10.11769-27.82364,2.52942,29.08835,2.52942,29.08835,3.79413,29.08835,0,32.88248S308.163,407.76271,308.163,407.76271Z" transform="translate(-117.32365 -104.99861)" fill="#a0616a"></path><path d="M286.66292,550.675l-68.29438-6.32356s-8.853,41.73546-6.32355,58.17669,3.79413,63.23554,3.79413,63.23554,2.52942,84.73562,6.32355,89.79446,16.44124,3.79413,20.23538,6.32355,10.11768-5.05884,10.11768-6.32355-7.58826-1.26471-3.79413-8.853-10.11769-29.08835-6.32355-39.206,10.11768-24.0295,6.32355-29.08834,2.52942-69.55909,2.52942-69.55909,31.61777,45.52958,31.61777,65.765-2.52942,67.02966-3.79413,72.08851-2.52943,6.32355,0,10.11768,5.05884,7.58827,3.79413,8.853,22.76479,0,22.76479-7.58827-1.26471-7.58826,1.26471-13.91182,3.79413-82.20619,3.79413-82.20619Z" transform="translate(-117.32365 -104.99861)" fill="#2f2e41"></path><path d="M225.95681,422.93923l-3.79414,7.58827s-40.47074,12.64711-41.73545,39.206l34.14719,56.912s2.52942,3.79413,1.26471,6.32356-2.52942,1.26471-1.26471,5.05884,1.26471,2.52942,1.26471,5.05884-3.79413,1.26471,0,2.52942-1.26471,0,12.64711,3.79413,55.64727,2.52943,55.64727,2.52943l-7.58827-73.35322L284.1335,463.41l-10.11769-30.35306s-6.32355-1.26471-10.11768,1.26471-8.853-2.52942-8.853-2.52942S248.7216,422.93923,225.95681,422.93923Z" transform="translate(-117.32365 -104.99861)" fill="#575a89"></path><path d="M267.69226,434.32163l6.32355-1.26471s25.29422-7.58826,26.55893-13.91182,7.58826-13.91182,7.58826-13.91182,20.23537-5.05884,18.97066,11.3824-6.32355,21.50008-8.853,24.0295S287.92763,463.41,282.86879,463.41,267.69226,434.32163,267.69226,434.32163Z" transform="translate(-117.32365 -104.99861)" fill="#575a89"></path><path d="M182.95664,464.67469l-2.52942,5.05884-1.26471,45.52959s-7.58826,5.05884-3.79413,7.58826,12.6471,13.91182,15.17653,13.91182,16.44124-6.32356,16.44124-8.853-2.52943-25.29421-2.52943-25.29421Z" transform="translate(-117.32365 -104.99861)" fill="#575a89"></path><path d="M229.75094,755.55815s0,12.64711-1.26471,15.17653-3.79413,15.17653,3.79413,15.17653a30.69,30.69,0,0,0,12.64711-2.52942s0-7.58827,3.79413-8.853,12.64711-11.38239,8.853-13.91182-11.38239-5.05884-11.38239-5.05884Z" transform="translate(-117.32365 -104.99861)" fill="#2f2e41"></path><path d="M284.1335,761.8817s-7.58827,17.706,0,18.97067,17.70595,0,18.97066-2.52943,3.79413-5.05884,6.32355-3.79413S333.45722,760.617,325.869,758.08757a21.89658,21.89658,0,0,0-13.91182,0l-7.58826-3.79413Z" transform="translate(-117.32365 -104.99861)" fill="#2f2e41"></path><path d="M246.38062,420.078a2.59772,2.59772,0,0,0,1.02922-.2843,2.65925,2.65925,0,0,0,.95915-1.65971l2.58292-9.15084c.98006-3.47217,2.55417-7.5279,6.08651-8.26208a5.74082,5.74082,0,0,0,2.1315-.56726,3.6897,3.6897,0,0,0,1.15749-2.85443l1.10671-11.82779c.29921-3.19775.58306-6.52285-.53242-9.53465-1.64542-4.44262-6.15671-7.36765-10.819-8.20862s-9.46523.0996-14.00348,1.45924c-6.88419,2.06247-14.01322,5.61255-17.004,12.14715-1.73151,3.78317-1.83811,8.09692-1.60662,12.25106.23835,4.27742.83348,8.63751,2.79923,12.444a37.301,37.301,0,0,0,3.79092,5.57158c2.13486,2.76327,4.75353,8.16576,8.28683,9.19679C236.3289,421.9605,242.34447,420.60218,246.38062,420.078Z" transform="translate(-117.32365 -104.99861)" fill="#2f2e41"></path><path d="M947.42886,688.57113c0,38.029,23.85743,68.80166,53.34062,68.80166" transform="translate(-117.32365 -104.99861)" fill="#2f2e41"></path><path d="M1000.76948,757.37279c0-38.45634,26.6235-69.57472,59.525-69.57472" transform="translate(-117.32365 -104.99861)" fill="#6c63ff"></path><path d="M966.75517,692.01852c0,36.12355,15.21343,65.35427,34.01431,65.35427" transform="translate(-117.32365 -104.99861)" fill="#6c63ff"></path><path d="M1000.76948,757.37279c0-49.13865,30.77261-88.901,68.80166-88.901" transform="translate(-117.32365 -104.99861)" fill="#2f2e41"></path><path d="M989.548,757.85785s7.56457-.233,9.84434-1.85638,11.63623-3.56182,12.20179-.95825,11.36815,12.949,2.82778,13.01787-19.844-1.3303-22.11941-2.71632S989.548,757.85785,989.548,757.85785Z" transform="translate(-117.32365 -104.99861)" fill="#a8a8a8"></path><path d="M1014.57431,767.15477c-8.54037.06891-19.844-1.33028-22.1194-2.71631-1.73283-1.05554-2.42334-4.843-2.65438-6.59046-.16.00688-.25254.00984-.25254.00984s.47912,6.10089,2.75451,7.48692,13.579,2.78522,22.1194,2.71631c2.46527-.01988,3.31682-.897,3.27006-2.19605C1017.34948,766.64988,1016.40924,767.14,1014.57431,767.15477Z" transform="translate(-117.32365 -104.99861)" opacity="0.2"></path></svg>-->
        <?php if (!empty($classRooms)) { ?>
        <div class="card" style="min-height: 70vh;">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col" style="width: 46px"><?= $this->Paginator->sort('id', '#') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('name', 'Adı') ?></th>
                        <th scope="col" style="width: 150px"><?= $this->Paginator->sort('created', 'Oluşturma') ?></th>
                        <th scope="col" style="width: 150px"><?= $this->Paginator->sort('modified', 'Düzenleme') ?></th>
                        <th scope="col" class="actions"></th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($classRooms as $classRoom): ?>
                    <tr>
                        <td><?= $this->Number->format($classRoom->id) ?></td>
                        <td><?= h($classRoom->name) ?></td>
                        <td><?= h($classRoom->created) ?></td>
                        <td><?= h($classRoom->modified) ?></td>
                        <td class="actions">
                            <div class="btn-group btn-group-sm" role="group">
                                <?= $this->Html->link($this->BackOffice->icon('launch', 'md-16'), ['action' => 'view', $classRoom->id], [ 'escape' => false, 'class' => 'btn btn-dark', 'title' => 'Göster', 'data-toggle' => 'tooltip' ]) ?>
                                <?= $this->Html->link($this->BackOffice->icon('create', 'md-16'), ['action' => 'edit', $classRoom->id], [ 'escape' => false, 'class' => 'btn btn-dark', 'title' => 'Düzenle', 'data-toggle' => 'tooltip' ]) ?>
                                <?= $this->Form->postLink($this->BackOffice->icon('clear', 'md-16'), ['action' => 'delete', $classRoom->id], [ 'confirm' => __('{0} no`lu kayıt silinecek emin misiniz?', $classRoom->id), 'escape' => false, 'class' => 'btn btn-dark', 'title' => 'Sil', 'data-toggle' => 'tooltip' ]) ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php } ?>
    </div>
    <div class="col-12">
        <div class="row align-items-baseline">
            <div class="col-sm-5 text-muted small d-none d-md-block">
                <?= $this->Paginator->counter(__('{{count}} kayıt arasından {{current}} kayıt gösteriliyor. Sayfa {{page}} / {{pages}}')) ?>
            </div>
            <div class="col-md-7">
                <ul class="pagination justify-content-end">
                    <?= $this->Paginator->first('<< ' . __('first'), [ 'class' => 'page-item' ]) ?>
                    <?= $this->Paginator->prev('< ' . __('previous')) ?>
                    <?= $this->Paginator->numbers() ?>
                    <?= $this->Paginator->next(__('next') . ' >') ?>
                    <?= $this->Paginator->last(__('last') . ' >>') ?>
                </ul>
            </div>
        </div>
    </div>
</div>
