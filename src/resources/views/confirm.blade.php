@php
    $hideNav = true;
@endphp

@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/common.css') }}" />
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}" />
@endsection 

@section('content')
    <div class="confirm__content">
      <div class="confirm__heading">
        <h2>Confirm</h2>
      </div>
      <form class="form" action="{{ route('store') }}" method="post">
        @csrf
        <div class="confirm-table">
          <table class="confirm-table__inner">
            <tr class="confirm-table__row">
              <th class="confirm-table__header">お名前</th>
              <td class="confirm-table__text">
                <input type="text" name="last_name" value="{{ $contact['last_name'] }}" readonly/> 
                <input type="text" name="first_name" value="{{ $contact['first_name'] }}" readonly/>
              </td>
            </tr>

            <tr class="confirm-table__row">
              <th class="confirm-table__header">性別</th>
              <td class="confirm-table__text">
                <input type="text" name="gender" value=" {{ $contact['gender'] == 1 ? '男性' : ($contact['gender'] == 2 ? '女性' : 'その他') }}" readonly/>
              </td>
            </tr>

            <tr class="confirm-table__row">
              <th class="confirm-table__header">メールアドレス</th>
              <td class="confirm-table__text">
                <input type="email" name="email" value="{{ $contact['email'] }}" readonly/>
              </td>
            </tr>
            <tr class="confirm-table__row">
              <th class="confirm-table__header">電話番号</th>
              <td class="confirm-table__text">
                <input type="tel" name="tel" value="{{ implode('-', $contact['tel']) }}" readonly/>
              </td>
            </tr>

             <tr class="confirm-table__row">
              <th class="confirm-table__header">住所</th>
              <td class="confirm-table__text">
                <input type="text" name="address" value="{{ $contact['address'] }}" readonly/>
              </td>
            </tr>

             <tr class="confirm-table__row">
              <th class="confirm-table__header">建物名</th>
              <td class="confirm-table__text">
                <input type="text" name="building" value="{{ $contact['building'] ?? 'なし' }}" readonly/>
              </td>
            </tr>

             <tr class="confirm-table__row">
              <th class="confirm-table__header">お問い合わせの種類</th>
              <td class="confirm-table__text">
                <input type="text" name="content" value="{{ $contact['content'] }}" readonly/>
              </td>
            </tr>

            <tr class="confirm-table__row">
              <th class="confirm-table__header">お問い合わせ内容</th>
              <td class="confirm-table__text">
                <input type="text" name="detail" value="{{ $contact['detail'] }}" readonly/>
              </td>
            </tr>
          </table>
        </div>
        
        <div class="form__button">
          <button class="form__button-submit" type="submit" name="submit" value="complete">送信</button>
          <button class="form__button-submit back-button" type="button"  onClick="window.history.back()"  name="back" value="back">修正</button>

        </div>
      </form>
    </div>
@endsection