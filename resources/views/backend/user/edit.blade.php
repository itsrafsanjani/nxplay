@extends('backend.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- main title -->
            <div class="col-12">
                <div class="main__title">
                    <h2>Edit user</h2>
                </div>
            </div>
            <!-- end main title -->



            <!-- content tabs -->
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="tab-1" role="tabpanel" aria-labelledby="1-tab">
                    <div class="col-12">
                        <div class="row">
                            <!-- details form -->
                            <div class="col-12 col-lg-6">
                                <form action="{{ route('users.update', $user->id) }}" class="profile__form" method="post">
                                    @csrf
                                    @method('PATCH')

                                    <div class="row">
                                        <div class="col-12">
                                            <h4 class="profile__title">Profile details</h4>
                                        </div>

                                        <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                            <div class="profile__group">
                                                <label class="profile__label" for="email">Email</label>
                                                <input id="email" type="text" name="email" class="profile__input" value="{{ $user->email }}" disabled>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                            <div class="profile__group">
                                                <label class="profile__label" for="name">Name</label>
                                                <input id="name" type="text" name="name" class="profile__input" value="{{ $user->name }}">
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                            <div class="profile__group">
                                                <label class="profile__label" for="id">Id</label>
                                                <input id="id" type="text" name="id" class="profile__input" value="{{ $user->id }}" disabled>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                            <div class="profile__group">
                                                <label class="profile__label" for="rights">Role</label>
                                                <select class="js-example-basic-single" id="rights" name="role">
                                                    <option value="{{ $user->role }}">@if($user->role == 1) Admin @else User @endif</option>
                                                    <option value="0">User</option>
                                                    <option value="1">Admin</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <button class="profile__btn" type="submit">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- end details form -->
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="tab-2" role="tabpanel" aria-labelledby="2-tab">
                    <!-- table -->
                    <div class="col-12">
                        <div class="main__table-wrap">
                            <table class="main__table">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>ITEM</th>
                                    <th>AUTHOR</th>
                                    <th>TEXT</th>
                                    <th>LIKE / DISLIKE</th>
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
                                        <div class="main__table-text">John Doe</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text">Lorem Ipsum is simply dummy text...</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text">12 / 7</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text">24 Oct 2019</div>
                                    </td>
                                    <td>
                                        <div class="main__table-btns">
                                            <a href="#modal-view" class="main__table-btn main__table-btn--view open-modal">
                                                <i class="icon ion-ios-eye"></i>
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
                                        <div class="main__table-text">John Doe</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text">Lorem Ipsum is simply dummy text...</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text">67 / 22</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text">24 Oct 2019</div>
                                    </td>
                                    <td>
                                        <div class="main__table-btns">
                                            <a href="#modal-view" class="main__table-btn main__table-btn--view open-modal">
                                                <i class="icon ion-ios-eye"></i>
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
                                        <div class="main__table-text">John Doe</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text">Lorem Ipsum is simply dummy text...</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text">44 / 5</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text">24 Oct 2019</div>
                                    </td>
                                    <td>
                                        <div class="main__table-btns">
                                            <a href="#modal-view" class="main__table-btn main__table-btn--view open-modal">
                                                <i class="icon ion-ios-eye"></i>
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
                                        <div class="main__table-text">John Doe</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text">Lorem Ipsum is simply dummy text...</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text">20 / 6</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text">24 Oct 2019</div>
                                    </td>
                                    <td>
                                        <div class="main__table-btns">
                                            <a href="#modal-view" class="main__table-btn main__table-btn--view open-modal">
                                                <i class="icon ion-ios-eye"></i>
                                            </a>
                                            <a href="#modal-delete" class="main__table-btn main__table-btn--delete open-modal">
                                                <i class="icon ion-ios-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="main__table-text">27</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text">I Dream in Another Language</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text">John Doe</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text">Lorem Ipsum is simply dummy text...</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text">8 / 132</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text">24 Oct 2019</div>
                                    </td>
                                    <td>
                                        <div class="main__table-btns">
                                            <a href="#modal-view" class="main__table-btn main__table-btn--view open-modal">
                                                <i class="icon ion-ios-eye"></i>
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
                                        <div class="main__table-text">John Doe</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text">Lorem Ipsum is simply dummy text...</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text">6 / 1</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text">24 Oct 2019</div>
                                    </td>
                                    <td>
                                        <div class="main__table-btns">
                                            <a href="#modal-view" class="main__table-btn main__table-btn--view open-modal">
                                                <i class="icon ion-ios-eye"></i>
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
                                        <div class="main__table-text">John Doe</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text">Lorem Ipsum is simply dummy text...</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text">10 / 0</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text">24 Oct 2019</div>
                                    </td>
                                    <td>
                                        <div class="main__table-btns">
                                            <a href="#modal-view" class="main__table-btn main__table-btn--view open-modal">
                                                <i class="icon ion-ios-eye"></i>
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
                                        <div class="main__table-text">John Doe</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text">Lorem Ipsum is simply dummy text...</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text">13 / 14</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text">24 Oct 2019</div>
                                    </td>
                                    <td>
                                        <div class="main__table-btns">
                                            <a href="#modal-view" class="main__table-btn main__table-btn--view open-modal">
                                                <i class="icon ion-ios-eye"></i>
                                            </a>
                                            <a href="#modal-delete" class="main__table-btn main__table-btn--delete open-modal">
                                                <i class="icon ion-ios-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="main__table-text">31</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text">I Dream in Another Language</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text">John Doe</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text">Lorem Ipsum is simply dummy text...</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text">12 / 7</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text">24 Oct 2019</div>
                                    </td>
                                    <td>
                                        <div class="main__table-btns">
                                            <a href="#modal-view" class="main__table-btn main__table-btn--view open-modal">
                                                <i class="icon ion-ios-eye"></i>
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
                                        <div class="main__table-text">John Doe</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text">Lorem Ipsum is simply dummy text...</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text">67 / 22</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text">24 Oct 2019</div>
                                    </td>
                                    <td>
                                        <div class="main__table-btns">
                                            <a href="#modal-view" class="main__table-btn main__table-btn--view open-modal">
                                                <i class="icon ion-ios-eye"></i>
                                            </a>
                                            <a href="#modal-delete" class="main__table-btn main__table-btn--delete open-modal">
                                                <i class="icon ion-ios-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- end table -->

                    <!-- paginator -->
                    <div class="col-12">
                        <div class="paginator-wrap">
                            <span>10 from 23</span>

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

                <div class="tab-pane fade" id="tab-3" role="tabpanel" aria-labelledby="3-tab">
                    <!-- table -->
                    <div class="col-12">
                        <div class="main__table-wrap">
                            <table class="main__table">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>ITEM</th>
                                    <th>AUTHOR</th>
                                    <th>TEXT</th>
                                    <th>RATING</th>
                                    <th>LIKE / DISLIKE</th>
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
                                        <div class="main__table-text">John Doe</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text">Lorem Ipsum is simply dummy text...</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text main__table-text--rate"><i class="icon ion-ios-star"></i> 7.9</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text">12 / 7</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text">24 Oct 2019</div>
                                    </td>
                                    <td>
                                        <div class="main__table-btns">
                                            <a href="#modal-view2" class="main__table-btn main__table-btn--view open-modal">
                                                <i class="icon ion-ios-eye"></i>
                                            </a>
                                            <a href="#modal-delete2" class="main__table-btn main__table-btn--delete open-modal">
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
                                        <div class="main__table-text">John Doe</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text">Lorem Ipsum is simply dummy text...</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text main__table-text--rate"><i class="icon ion-ios-star"></i> 8.6</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text">67 / 22</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text">24 Oct 2019</div>
                                    </td>
                                    <td>
                                        <div class="main__table-btns">
                                            <a href="#modal-view2" class="main__table-btn main__table-btn--view open-modal">
                                                <i class="icon ion-ios-eye"></i>
                                            </a>
                                            <a href="#modal-delete2" class="main__table-btn main__table-btn--delete open-modal">
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
                                        <div class="main__table-text">John Doe</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text">Lorem Ipsum is simply dummy text...</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text main__table-text--rate"><i class="icon ion-ios-star"></i> 6.0</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text">44 / 5</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text">24 Oct 2019</div>
                                    </td>
                                    <td>
                                        <div class="main__table-btns">
                                            <a href="#modal-view2" class="main__table-btn main__table-btn--view open-modal">
                                                <i class="icon ion-ios-eye"></i>
                                            </a>
                                            <a href="#modal-delete2" class="main__table-btn main__table-btn--delete open-modal">
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
                                        <div class="main__table-text">John Doe</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text">Lorem Ipsum is simply dummy text...</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text main__table-text--rate"><i class="icon ion-ios-star"></i> 9.1</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text">20 / 6</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text">24 Oct 2019</div>
                                    </td>
                                    <td>
                                        <div class="main__table-btns">
                                            <a href="#modal-view2" class="main__table-btn main__table-btn--view open-modal">
                                                <i class="icon ion-ios-eye"></i>
                                            </a>
                                            <a href="#modal-delete2" class="main__table-btn main__table-btn--delete open-modal">
                                                <i class="icon ion-ios-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="main__table-text">27</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text">I Dream in Another Language</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text">John Doe</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text">Lorem Ipsum is simply dummy text...</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text main__table-text--rate"><i class="icon ion-ios-star"></i> 5.5</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text">8 / 132</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text">24 Oct 2019</div>
                                    </td>
                                    <td>
                                        <div class="main__table-btns">
                                            <a href="#modal-view2" class="main__table-btn main__table-btn--view open-modal">
                                                <i class="icon ion-ios-eye"></i>
                                            </a>
                                            <a href="#modal-delete2" class="main__table-btn main__table-btn--delete open-modal">
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
                                        <div class="main__table-text">John Doe</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text">Lorem Ipsum is simply dummy text...</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text main__table-text--rate"><i class="icon ion-ios-star"></i> 7.0</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text">6 / 1</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text">24 Oct 2019</div>
                                    </td>
                                    <td>
                                        <div class="main__table-btns">
                                            <a href="#modal-view2" class="main__table-btn main__table-btn--view open-modal">
                                                <i class="icon ion-ios-eye"></i>
                                            </a>
                                            <a href="#modal-delete2" class="main__table-btn main__table-btn--delete open-modal">
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
                                        <div class="main__table-text">John Doe</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text">Lorem Ipsum is simply dummy text...</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text main__table-text--rate"><i class="icon ion-ios-star"></i> 9.0</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text">10 / 0</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text">24 Oct 2019</div>
                                    </td>
                                    <td>
                                        <div class="main__table-btns">
                                            <a href="#modal-view2" class="main__table-btn main__table-btn--view open-modal">
                                                <i class="icon ion-ios-eye"></i>
                                            </a>
                                            <a href="#modal-delete2" class="main__table-btn main__table-btn--delete open-modal">
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
                                        <div class="main__table-text">John Doe</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text">Lorem Ipsum is simply dummy text...</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text main__table-text--rate"><i class="icon ion-ios-star"></i> 6.2</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text">13 / 14</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text">24 Oct 2019</div>
                                    </td>
                                    <td>
                                        <div class="main__table-btns">
                                            <a href="#modal-view2" class="main__table-btn main__table-btn--view open-modal">
                                                <i class="icon ion-ios-eye"></i>
                                            </a>
                                            <a href="#modal-delete2" class="main__table-btn main__table-btn--delete open-modal">
                                                <i class="icon ion-ios-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="main__table-text">31</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text">I Dream in Another Language</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text">John Doe</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text">Lorem Ipsum is simply dummy text...</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text main__table-text--rate"><i class="icon ion-ios-star"></i> 7.9</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text">12 / 7</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text">24 Oct 2019</div>
                                    </td>
                                    <td>
                                        <div class="main__table-btns">
                                            <a href="#modal-view2" class="main__table-btn main__table-btn--view open-modal">
                                                <i class="icon ion-ios-eye"></i>
                                            </a>
                                            <a href="#modal-delete2" class="main__table-btn main__table-btn--delete open-modal">
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
                                        <div class="main__table-text">John Doe</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text">Lorem Ipsum is simply dummy text...</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text main__table-text--rate"><i class="icon ion-ios-star"></i> 8.6</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text">67 / 22</div>
                                    </td>
                                    <td>
                                        <div class="main__table-text">24 Oct 2019</div>
                                    </td>
                                    <td>
                                        <div class="main__table-btns">
                                            <a href="#modal-view2" class="main__table-btn main__table-btn--view open-modal">
                                                <i class="icon ion-ios-eye"></i>
                                            </a>
                                            <a href="#modal-delete2" class="main__table-btn main__table-btn--delete open-modal">
                                                <i class="icon ion-ios-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- end table -->

                    <!-- paginator -->
                    <div class="col-12">
                        <div class="paginator-wrap">
                            <span>10 from 32</span>

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
            <!-- end content tabs -->
        </div>
    </div>
@endsection
