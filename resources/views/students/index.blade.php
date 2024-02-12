@extends('layouts.layout')

 
  @section('head')
<title>Студенты | ActQA</title>
@endsection 
@section('content')
<h1>Студенты</h1>
    <div class="">

	
                    @if (session()->has('status'))

                        <div class="flex justify-center items-center">
                            <p class="ml-3 text-sm font-bold text-green-600">{{ session()->get('status') }}</p>
                        </div>
                    @endif

                    <div class="mt-1 mb-4">
                        <x-primary-button>
                            <a href="{{ route('students.create') }}">{{ __('+ Добавить студента') }}</a>
                        </x-primary-button>
                    </div>
                    <div class="table-overfolow">
                        <table class="table-list">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Имя</th>
                                    <th>Телефон</th>
                                    <th>Роль</th>
                                    
                                <th>Обновленно</th>
                                <th>Дата создания</th>
                                    <th>
                                        
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
								@forelse ($users as $user)
                                <tr class="user-row">
                                    <td>{{ $user->id }}</td>
									<td>
                                        <a  class="user-row__link" href="{{ route('students.show', $user->id) }}">
											<img src="{{ asset('storage/images/'.$user->avatar) }}" alt="">
											{{ $user->first_name }} {{ $user->last_name }}
										</a>
									</td>
                                  
                                    <td>{{ $user->phone }}</td>
                                    <td>{{ $user->role }}</td>
                                    <td>{{ $user->upodate_at }}</td>
                                    <td>{{ $user->created_at }}</td>
                                    <td >
										<div class="actions-btns-row">
											<!--  -->
											<a  class="btn-student-edit btn-edit" href="{{ route('students.edit', $user->id) }}">
												<svg  viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="m18 10-4-4m4 4 3-3-4-4-3 3m4 4-1 1m-3-5-6 6v4h4l2.5-2.5m5.5.5v6h-8M10 4H4v16h3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
											</a>
								
											<form action="{{ route('students.destroy', $user->id) }}" method="POST"
												onsubmit="return confirm('{{ trans('are You Sure ? ') }}');"
												style="display: inline-block;">
												<input type="hidden" name="_method" value="DELETE">
												<input type="hidden" name="_token" value="{{ csrf_token() }}">
												<button type="submit" class="btn-delete"
													value="Delete">
													<svg   viewBox="0 -0.5 21 21" xmlns="http://www.w3.org/2000/svg"><path d="M7.35 16h2.1V8h-2.1v8Zm4.2 0h2.1V8h-2.1v8Zm-6.3 2h10.5V6H5.25v12Zm2.1-14h6.3V2h-6.3v2Zm8.4 0V0H5.25v4H0v2h3.15v14h14.7V6H21V4h-5.25Z" fill="currentColor" fill-rule="evenodd"/></svg>
												</button>
											</form>
										</div>
                                    </td>
                                </tr>
                                @empty
									<td colspan="7"  ><b>No Users</b></>
								@endforelse
                            </tbody>
                        </table>
                 </div>
                 
   
    </div>

@endsection