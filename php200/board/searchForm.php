<form method="post" action="./searchResult.php">
    <input type="text" name="searchKeyword" placeholder="검색어 입력" required />
    <select name="option" required>
        <!--던질때 name="option"-->
        <option value="title">제목</option>
        <option value="content">내용</option>
        <option value="tandc">제목과 내용</option>
        <option value="torc">제목 또는 내용</option>
    </select>
    <input type="submit" value="검색" />
</form>