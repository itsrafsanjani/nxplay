@extends('backend.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- main title -->
            <div class="col-12">
                <div class="main__title">
                    <h2>Catalog</h2>

                    <span class="main__title-stat">14,452 Total</span>

                    <div class="main__title-wrap">
                        <!-- filter sort -->
                        <div class="filter" id="filter__sort">
                            <span class="filter__item-label">Sort by:</span>

                            <div class="filter__item-btn dropdown-toggle" role="navigation" id="filter-sort" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <input type="button" value="Date created">
                                <span></span>
                            </div>

                            <ul class="filter__item-menu dropdown-menu scrollbar-dropdown" aria-labelledby="filter-sort">
                                <li>Date created</li>
                                <li>Rating</li>
                                <li>Views</li>
                            </ul>
                        </div>
                        <!-- end filter sort -->

                        <!-- search -->
                        <form action="#" class="main__title-form">
                            <input type="text" placeholder="Find movie / tv series..">
                            <button type="button">
                                <i class="icon ion-ios-search"></i>
                            </button>
                        </form>
                        <!-- end search -->
                    </div>
                </div>
            </div>
            <!-- end main title -->

            <!-- users -->
            <div class="col-12">
                <div class="main__table-wrap">
                    <table class="main__table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>TITLE</th>
                            <th>RATING</th>
                            <th>CATEGORY</th>
                            <th>VIEWS</th>
                            <th>STATUS</th>
                            <th>CRAETED DATE</th>
                            <th>ACTIONS</th>
                        </tr>
                        </thead>

                        <tbody>
                        <tr>
                            <td>
                                <div class="main__table-text">23</div>
                            </td>
                            <td>
                                <div class="main__table-text">I Dream in Another Language</div>
                            </td>
                            <td>
                                <div class="main__table-text main__table-text--rate"><i class="icon ion-ios-star"></i> 7.9</div>
                            </td>
                            <td>
                                <div class="main__table-text">Movie</div>
                            </td>
                            <td>
                                <div class="main__table-text">1392</div>
                            </td>
                            <td>
                                <div class="main__table-text main__table-text--green">Visible</div>
                            </td>
                            <td>
                                <div class="main__table-text">24 Oct 2019</div>
                            </td>
                            <td>
                                <div class="main__table-btns">
                                    <a href="#modal-status" class="main__table-btn main__table-btn--banned open-modal">
                                        <i class="icon ion-ios-lock"></i>
                                    </a>
                                    <a href="#" class="main__table-btn main__table-btn--view">
                                        <i class="icon ion-ios-eye"></i>
                                    </a>
                                    <a href="#" class="main__table-btn main__table-btn--edit">
                                        <i class="icon ion-ios-create"></i>
                                    </a>
                                    <a href="#modal-delete" class="main__table-btn main__table-btn--delete open-modal">
                                        <i class="icon ion-ios-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="main__table-text">24</div>
                            </td>
                            <td>
                                <div class="main__table-text">Benched</div>
                            </td>
                            <td>
                                <div class="main__table-text main__table-text--rate"><i class="icon ion-ios-star"></i> 7.1</div>
                            </td>
                            <td>
                                <div class="main__table-text">Movie</div>
                            </td>
                            <td>
                                <div class="main__table-text">1093</div>
                            </td>
                            <td>
                                <div class="main__table-text main__table-text--red">Hidden</div>
                            </td>
                            <td>
                                <div class="main__table-text">24 Oct 2019</div>
                            </td>
                            <td>
                                <div class="main__table-btns">
                                    <a href="#modal-status" class="main__table-btn main__table-btn--banned open-modal">
                                        <i class="icon ion-ios-lock"></i>
                                    </a>
                                    <a href="#" class="main__table-btn main__table-btn--view">
                                        <i class="icon ion-ios-eye"></i>
                                    </a>
                                    <a href="#" class="main__table-btn main__table-btn--edit">
                                        <i class="icon ion-ios-create"></i>
                                    </a>
                                    <a href="#modal-delete" class="main__table-btn main__table-btn--delete open-modal">
                                        <i class="icon ion-ios-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="main__table-text">25</div>
                            </td>
                            <td>
                                <div class="main__table-text">Whitney</div>
                            </td>
                            <td>
                                <div class="main__table-text main__table-text--rate"><i class="icon ion-ios-star"></i> 6.3</div>
                            </td>
                            <td>
                                <div class="main__table-text">TV Series</div>
                            </td>
                            <td>
                                <div class="main__table-text">723</div>
                            </td>
                            <td>
                                <div class="main__table-text main__table-text--green">Visible</div>
                            </td>
                            <td>
                                <div class="main__table-text">24 Oct 2019</div>
                            </td>
                            <td>
                                <div class="main__table-btns">
                                    <a href="#modal-status" class="main__table-btn main__table-btn--banned open-modal">
                                        <i class="icon ion-ios-lock"></i>
                                    </a>
                                    <a href="#" class="main__table-btn main__table-btn--view">
                                        <i class="icon ion-ios-eye"></i>
                                    </a>
                                    <a href="#" class="main__table-btn main__table-btn--edit">
                                        <i class="icon ion-ios-create"></i>
                                    </a>
                                    <a href="#modal-delete" class="main__table-btn main__table-btn--delete open-modal">
                                        <i class="icon ion-ios-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="main__table-text">26</div>
                            </td>
                            <td>
                                <div class="main__table-text">Blindspotting</div>
                            </td>
                            <td>
                                <div class="main__table-text main__table-text--rate"><i class="icon ion-ios-star"></i> 8.4</div>
                            </td>
                            <td>
                                <div class="main__table-text">TV Series</div>
                            </td>
                            <td>
                                <div class="main__table-text">2457</div>
                            </td>
                            <td>
                                <div class="main__table-text main__table-text--green">Visible</div>
                            </td>
                            <td>
                                <div class="main__table-text">24 Oct 2019</div>
                            </td>
                            <td>
                                <div class="main__table-btns">
                                    <a href="#modal-status" class="main__table-btn main__table-btn--banned open-modal">
                                        <i class="icon ion-ios-lock"></i>
                                    </a>
                                    <a href="#" class="main__table-btn main__table-btn--view">
                                        <i class="icon ion-ios-eye"></i>
                                    </a>
                                    <a href="#" class="main__table-btn main__table-btn--edit">
                                        <i class="icon ion-ios-create"></i>
                                    </a>
                                    <a href="#modal-delete" class="main__table-btn main__table-btn--delete open-modal">
                                        <i class="icon ion-ios-trash"></i>
                                    </a>
                                </div>
                            </td>
                        <tr>
                            <td>
                                <div class="main__table-text">27</div>
                            </td>
                            <td>
                                <div class="main__table-text">I Dream in Another Language</div>
                            </td>
                            <td>
                                <div class="main__table-text main__table-text--rate"><i class="icon ion-ios-star"></i> 7.9</div>
                            </td>
                            <td>
                                <div class="main__table-text">Movie</div>
                            </td>
                            <td>
                                <div class="main__table-text">1392</div>
                            </td>
                            <td>
                                <div class="main__table-text main__table-text--green">Visible</div>
                            </td>
                            <td>
                                <div class="main__table-text">24 Oct 2019</div>
                            </td>
                            <td>
                                <div class="main__table-btns">
                                    <a href="#modal-status" class="main__table-btn main__table-btn--banned open-modal">
                                        <i class="icon ion-ios-lock"></i>
                                    </a>
                                    <a href="#" class="main__table-btn main__table-btn--view">
                                        <i class="icon ion-ios-eye"></i>
                                    </a>
                                    <a href="#" class="main__table-btn main__table-btn--edit">
                                        <i class="icon ion-ios-create"></i>
                                    </a>
                                    <a href="#modal-delete" class="main__table-btn main__table-btn--delete open-modal">
                                        <i class="icon ion-ios-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="main__table-text">28</div>
                            </td>
                            <td>
                                <div class="main__table-text">Benched</div>
                            </td>
                            <td>
                                <div class="main__table-text main__table-text--rate"><i class="icon ion-ios-star"></i> 7.1</div>
                            </td>
                            <td>
                                <div class="main__table-text">TV Series</div>
                            </td>
                            <td>
                                <div class="main__table-text">1093</div>
                            </td>
                            <td>
                                <div class="main__table-text main__table-text--red">Hidden</div>
                            </td>
                            <td>
                                <div class="main__table-text">24 Oct 2019</div>
                            </td>
                            <td>
                                <div class="main__table-btns">
                                    <a href="#modal-status" class="main__table-btn main__table-btn--banned open-modal">
                                        <i class="icon ion-ios-lock"></i>
                                    </a>
                                    <a href="#" class="main__table-btn main__table-btn--view">
                                        <i class="icon ion-ios-eye"></i>
                                    </a>
                                    <a href="#" class="main__table-btn main__table-btn--edit">
                                        <i class="icon ion-ios-create"></i>
                                    </a>
                                    <a href="#modal-delete" class="main__table-btn main__table-btn--delete open-modal">
                                        <i class="icon ion-ios-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="main__table-text">29</div>
                            </td>
                            <td>
                                <div class="main__table-text">Whitney</div>
                            </td>
                            <td>
                                <div class="main__table-text main__table-text--rate"><i class="icon ion-ios-star"></i> 6.3</div>
                            </td>
                            <td>
                                <div class="main__table-text">Cartoon</div>
                            </td>
                            <td>
                                <div class="main__table-text">723</div>
                            </td>
                            <td>
                                <div class="main__table-text main__table-text--green">Visible</div>
                            </td>
                            <td>
                                <div class="main__table-text">24 Oct 2019</div>
                            </td>
                            <td>
                                <div class="main__table-btns">
                                    <a href="#modal-status" class="main__table-btn main__table-btn--banned open-modal">
                                        <i class="icon ion-ios-lock"></i>
                                    </a>
                                    <a href="#" class="main__table-btn main__table-btn--view">
                                        <i class="icon ion-ios-eye"></i>
                                    </a>
                                    <a href="#" class="main__table-btn main__table-btn--edit">
                                        <i class="icon ion-ios-create"></i>
                                    </a>
                                    <a href="#modal-delete" class="main__table-btn main__table-btn--delete open-modal">
                                        <i class="icon ion-ios-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="main__table-text">30</div>
                            </td>
                            <td>
                                <div class="main__table-text">Blindspotting</div>
                            </td>
                            <td>
                                <div class="main__table-text main__table-text--rate"><i class="icon ion-ios-star"></i> 8.4</div>
                            </td>
                            <td>
                                <div class="main__table-text">Movie</div>
                            </td>
                            <td>
                                <div class="main__table-text">2457</div>
                            </td>
                            <td>
                                <div class="main__table-text main__table-text--green">Visible</div>
                            </td>
                            <td>
                                <div class="main__table-text">24 Oct 2019</div>
                            </td>
                            <td>
                                <div class="main__table-btns">
                                    <a href="#modal-status" class="main__table-btn main__table-btn--banned open-modal">
                                        <i class="icon ion-ios-lock"></i>
                                    </a>
                                    <a href="#" class="main__table-btn main__table-btn--view">
                                        <i class="icon ion-ios-eye"></i>
                                    </a>
                                    <a href="#" class="main__table-btn main__table-btn--edit">
                                        <i class="icon ion-ios-create"></i>
                                    </a>
                                    <a href="#modal-delete" class="main__table-btn main__table-btn--delete open-modal">
                                        <i class="icon ion-ios-trash"></i>
                                    </a>
                                </div>
                            </td>
                        <tr>
                            <td>
                                <div class="main__table-text">31</div>
                            </td>
                            <td>
                                <div class="main__table-text">I Dream in Another Language</div>
                            </td>
                            <td>
                                <div class="main__table-text main__table-text--rate"><i class="icon ion-ios-star"></i> 7.9</div>
                            </td>
                            <td>
                                <div class="main__table-text">Movie</div>
                            </td>
                            <td>
                                <div class="main__table-text">1392</div>
                            </td>
                            <td>
                                <div class="main__table-text main__table-text--green">Visible</div>
                            </td>
                            <td>
                                <div class="main__table-text">24 Oct 2019</div>
                            </td>
                            <td>
                                <div class="main__table-btns">
                                    <a href="#modal-status" class="main__table-btn main__table-btn--banned open-modal">
                                        <i class="icon ion-ios-lock"></i>
                                    </a>
                                    <a href="#" class="main__table-btn main__table-btn--view">
                                        <i class="icon ion-ios-eye"></i>
                                    </a>
                                    <a href="#" class="main__table-btn main__table-btn--edit">
                                        <i class="icon ion-ios-create"></i>
                                    </a>
                                    <a href="#modal-delete" class="main__table-btn main__table-btn--delete open-modal">
                                        <i class="icon ion-ios-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="main__table-text">32</div>
                            </td>
                            <td>
                                <div class="main__table-text">Benched</div>
                            </td>
                            <td>
                                <div class="main__table-text main__table-text--rate"><i class="icon ion-ios-star"></i> 7.1</div>
                            </td>
                            <td>
                                <div class="main__table-text">Movie</div>
                            </td>
                            <td>
                                <div class="main__table-text">1093</div>
                            </td>
                            <td>
                                <div class="main__table-text main__table-text--red">Hidden</div>
                            </td>
                            <td>
                                <div class="main__table-text">24 Oct 2019</div>
                            </td>
                            <td>
                                <div class="main__table-btns">
                                    <a href="#modal-status" class="main__table-btn main__table-btn--banned open-modal">
                                        <i class="icon ion-ios-lock"></i>
                                    </a>
                                    <a href="#" class="main__table-btn main__table-btn--view">
                                        <i class="icon ion-ios-eye"></i>
                                    </a>
                                    <a href="#" class="main__table-btn main__table-btn--edit">
                                        <i class="icon ion-ios-create"></i>
                                    </a>
                                    <a href="#modal-delete" class="main__table-btn main__table-btn--delete open-modal">
                                        <i class="icon ion-ios-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- end users -->

            <!-- paginator -->
            <div class="col-12">
                <div class="paginator-wrap">
                    <span>10 from 14 452</span>

                    <ul class="paginator">
                        <li class="paginator__item paginator__item--prev">
                            <a href="#"><i class="icon ion-ios-arrow-back"></i></a>
                        </li>
                        <li class="paginator__item"><a href="#">1</a></li>
                        <li class="paginator__item paginator__item--active"><a href="#">2</a></li>
                        <li class="paginator__item"><a href="#">3</a></li>
                        <li class="paginator__item"><a href="#">4</a></li>
                        <li class="paginator__item paginator__item--next">
                            <a href="#"><i class="icon ion-ios-arrow-forward"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- end paginator -->
        </div>
    </div>
@endsection

@section('modal')
    <!-- modal status -->
    <div id="modal-status" class="zoom-anim-dialog mfp-hide modal">
        <h6 class="modal__title">Status change</h6>

        <p class="modal__text">Are you sure about immediately change status?</p>

        <div class="modal__btns">
            <button class="modal__btn modal__btn--apply" type="button">Apply</button>
            <button class="modal__btn modal__btn--dismiss" type="button">Dismiss</button>
        </div>
    </div>
    <!-- end modal status -->

    <!-- modal delete -->
    <div id="modal-delete" class="zoom-anim-dialog mfp-hide modal">
        <h6 class="modal__title">Item delete</h6>

        <p class="modal__text">Are you sure to permanently delete this item?</p>

        <div class="modal__btns">
            <button class="modal__btn modal__btn--apply" type="button">Delete</button>
            <button class="modal__btn modal__btn--dismiss" type="button">Dismiss</button>
        </div>
    </div>
    <!-- end modal delete -->
@endsection
