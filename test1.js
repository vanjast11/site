// -------------------- GETの場合 --------------------
$(window).load(function(){
	if(myChart !== "")
	  {
	    myChart.destroy();
	  };
	  
	  $.ajax({
	      type: "POST",
	      url: "./SalesDetail_test.php",
	      dataType : "json",
		  data : test = {"yy": yy,
				         "flg": 1}
	    }).done(function(data){
	        // 変数宣言
	        var jan = data[0]["money"];
	        var feb = data[1]["money"];
	        var mar = data[2]["money"];
	        var apr = data[3]["money"];
	        var may = data[4]["money"];
	        var jun = data[5]["money"];
	        var jul = data[6]["money"];
	        var aug = data[7]["money"];
	        var sep = data[8]["money"];
	        var oct = data[9]["money"];
	        var nov = data[10]["money"];
	        var dec = data[11]["money"];
	        
	        var jan2 = data[0]["count"];
	        var feb2 = data[1]["count"];
	        var mar2 = data[2]["count"];
	        var apr2 = data[3]["count"];
	        var may2 = data[4]["count"];
	        var jun2 = data[5]["count"];
	        var jul2 = data[6]["count"];
	        var aug2 = data[7]["count"];
	        var sep2 = data[8]["count"];
	        var oct2 = data[9]["count"];
	        var nov2 = data[10]["count"];
	        var dec2 = data[11]["count"];

			//軸の表示方法
	        var complexChartOption = {
	        	    responsive: true,
	        	    scales: {
	        	        yAxes: [{
	        	            id: "y-axis-1",   // Y軸のID
	        	            type: "linear",   // linear固定 
	        	            position: "left", // どちら側に表示される軸か？
	        	            ticks: {          // スケール
	        	                max: 0.2,
	        	                min: 0,
	        	                stepSize: 0.1
	        	            },
	        	        }, {
	        	            id: "y-axis-2",
	        	            type: "linear", 
	        	            position: "right",
	        	            ticks: {
	        	                max: 1.5,
	        	                min: 0,
	        	                stepSize: .5
	        	            },
	        	        }],
	        	    }
	        	};
	    	
	        //表示させたいデータ
	        var barChartData = {
	        	    labels: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'],
	        	    datasets: [
	        	    {
	        	    	type: 'line',
	        	        label: '今年の売り上げ',
	        	        data: [jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec],
	        	        borderColor : "rgba(254,97,132,0.8)",
	        	        backgroundColor : "rgba(254,97,132,0.5)",
	        	        yAxisID: "y-axis-1", 
	        	    },
	        	    {
	        	    	 type: 'bar', 
	        	        label: '今年の売り上げ個数',
	        	        data: [jan2, feb2, mar2, apr2, may2, jun2, jul2, aug2, sep2, oct2, nov2, dec2],
	        	        borderColor : "rgba(54,164,235,0.8)",
	        	        backgroundColor : "rgba(54,164,235,0.5)",
	        	        yAxisID: "y-axis-2", 
	        	    },
	        	    ],
	        	};
	        
	        //チャートメソッド呼び出し
	    	myChart = new Chart(ctx, {
	 
	            data: barChartData,
	            options: complexChartOption
	    	});
	    	
	    }).fail(function(XMLHttpRequest, status, e){
	      alert(e);
	    });
});

// -------------------- 年間をクリック --------------------
$("#year").on("click",()=>{
  if(myChart !== "")
  {
    myChart.destroy();
  };
  
  $.ajax({
      type: "POST",
      url: "SalesDetail_test.php",
      dataType : "json",
	  data : test = {"yy": yy,
			         "flg": 1}
    }).done(function(data){

        // 変数宣言
        var jan = data[0]["money"];
        var feb = data[1]["money"];
        var mar = data[2]["money"];
        var apr = data[3]["money"];
        var may = data[4]["money"];
        var jun = data[5]["money"];
        var jul = data[6]["money"];
        var aug = data[7]["money"];
        var sep = data[8]["money"];
        var oct = data[9]["money"];
        var nov = data[10]["money"];
        var dec = data[11]["money"];
        
        var jan2 = data[0]["count"];
        var feb2 = data[1]["count"];
        var mar2 = data[2]["count"];
        var apr2 = data[3]["count"];
        var may2 = data[4]["count"];
        var jun2 = data[5]["count"];
        var jul2 = data[6]["count"];
        var aug2 = data[7]["count"];
        var sep2 = data[8]["count"];
        var oct2 = data[9]["count"];
        var nov2 = data[10]["count"];
        var dec2 = data[11]["count"];

		//軸の表示方法
        var complexChartOption = {
        	    responsive: true,
        	    scales: {
        	        yAxes: [{
        	            id: "y-axis-1",   // Y軸のID
        	            type: "linear",   // linear固定 
        	            position: "left", // どちら側に表示される軸か？
        	            ticks: {          // スケール
        	                max: 0.2,
        	                min: 0,
        	                stepSize: 0.1
        	            },
        	        }, {
        	            id: "y-axis-2",
        	            type: "linear", 
        	            position: "right",
        	            ticks: {
        	                max: 1.5,
        	                min: 0,
        	                stepSize: .5
        	            },
        	        }],
        	    }
        	};
    	
        //表示させたいデータ
        var barChartData = {
        	    labels: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'],
        	    datasets: [
        	    {
        	    	type: 'line',
        	        label: '今年の売り上げ',
        	        data: [jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec],
        	        borderColor : "rgba(254,97,132,0.8)",
        	        backgroundColor : "rgba(254,97,132,0.5)",
        	        yAxisID: "y-axis-1", 
        	    },
        	    {
        	    	 type: 'bar', 
        	        label: '今年の売り上げ個数',
        	        data: [jan2, feb2, mar2, apr2, may2, jun2, jul2, aug2, sep2, oct2, nov2, dec2],
        	        borderColor : "rgba(54,164,235,0.8)",
        	        backgroundColor : "rgba(54,164,235,0.5)",
        	        yAxisID: "y-axis-2", 
        	    },
        	    ],
        	};
        
        //チャートメソッド呼び出し
    	myChart = new Chart(ctx, {
 
            data: barChartData,
            options: complexChartOption
    	});
    	
    }).fail(function(XMLHttpRequest, status, e){
      alert(e);
    });
});


// -------------------- 月間をクリック --------------------
$("#mon").on("click",()=>{
	  if(myChart !== "")
	  {
	    myChart.destroy();
	  };
	  
	  $.ajax({
	      type: "POST",
	      url: "SalesDetail_test.php",
	      dataType : "json",
		  data : test = {"ym": ym,
				         "dcount": dcount,
				         "flg": 2}
	    }).done(function(data){

	        // 変数宣言
	        var money = [];
	        var count = [];
	        for(var i = 0; i < dcount; i++)
	        {
		        money[i] = data[i]["money"];
		        count[i] = data[i]["count"];
	        }
	        
			//軸の表示方法
	        var complexChartOption = {
	        	    responsive: true,
	        	    scales: {
	        	        yAxes: [{
	        	            id: "y-axis-1",   // Y軸のID
	        	            type: "linear",   // linear固定 
	        	            position: "left", // どちら側に表示される軸か？
	        	            ticks: {          // スケール
	        	                max: 0.2,
	        	                min: 0,
	        	                stepSize: 0.1
	        	            },
	        	        }, {
	        	            id: "y-axis-2",
	        	            type: "linear", 
	        	            position: "right",
	        	            ticks: {
	        	                max: 1.5,
	        	                min: 0,
	        	                stepSize: .5
	        	            },
	        	        }],
	        	    }
	        	};
	    	
	        //表示させたいデータ
	        var barChartData = {
	        		labels: [],
	        	    datasets: [
	        	    {
	        	    	type: 'line',
	        	        label: '今月の売り上げ',
	        	        data: [],
	        	        borderColor : "rgba(254,97,132,0.8)",
	        	        backgroundColor : "rgba(254,97,132,0.5)",
	        	        yAxisID: "y-axis-1", 
	        	    },
	        	    {
	        	    	 type: 'bar', 
	        	        label: '今月の売り上げ個数',
	        	        data: [],
	        	        borderColor : "rgba(54,164,235,0.8)",
	        	        backgroundColor : "rgba(54,164,235,0.5)",
	        	        yAxisID: "y-axis-2", 
	        	    },
	        	    ],
	        	    
	        	};

	    	// ラベルに値をプッシュ
        	for(var i = 1; i <= dcount; i++ )
        	{
	        	barChartData.labels.push(i);
        	}	

        	// データに値をプッシュ
        	for(var i = 0; i < dcount; i++ )
        	{	//データセット0は売上金額の配列
	        	barChartData.datasets[0].data.push(money[i]);
	        	//データセット1は売上個数の配列
	        	barChartData.datasets[1].data.push(count[i]);
        	}
        	
	        //チャートメソッド呼び出し
	    	myChart = new Chart(ctx, {
	 
	            data: barChartData,
	            options: complexChartOption
	    	});
	    	
	    }).fail(function(XMLHttpRequest, status, e){
	      alert(e);
	    });
	});



// -------------------- 週間をクリック --------------------
$("#week").on("click",()=>{
  if(myChart != "")
  {
    myChart.destroy();
  };
  
  $.ajax({
      type: "POST",
      url: "SalesDetail_test.php",
      dataType : "json",
		 data : test = {"wcount": wcount,
				 			"yy": yy,
				 			"mm": mm,
				 			"dd": dd,
				 			"flg": 3}
    }).done(function(data){

        // 変数宣言
        var mon = data[6]["money"];
        var tue = data[5]["money"];
        var wed = data[4]["money"];
        var thu = data[3]["money"];
        var fri = data[2]["money"];
        var sat = data[1]["money"];
        var sun = data[0]["money"];
        var mon2 = data[6]["count"];
        var tue2 = data[5]["count"];
        var wed2 = data[4]["count"];
        var thu2 = data[3]["count"];
        var fri2 = data[2]["count"];
        var sat2 = data[1]["count"];
        var sun2 = data[0]["count"];

		//軸の表示方法
        var complexChartOption = {
        	    responsive: true,
        	    scales: {
        	        yAxes: [{
        	            id: "y-axis-1",   // Y軸のID
        	            type: "linear",   // linear固定 
        	            position: "left", // どちら側に表示される軸か？
        	            ticks: {          // スケール
        	                max: 0.2,
        	                min: 0,
        	                stepSize: 0.1
        	            },
        	        }, {
        	            id: "y-axis-2",
        	            type: "linear", 
        	            position: "right",
        	            ticks: {
        	                max: 1.5,
        	                min: 0,
        	                stepSize: .5
        	            },
        	        }],
        	    }
        	};
    	
        //表示させたいデータ
        var barChartData = {
        	    labels: ['月', '火', '水', '木', '金', '土', '日'],
        	    datasets: [
        	    {
        	    	type: 'line',
        	        label: '今週の売り上げ',
        	        data: [mon, tue, wed, thu, fri, sat, sun],
        	        borderColor : "rgba(254,97,132,0.8)",
        	        backgroundColor : "rgba(254,97,132,0.5)",
        	        yAxisID: "y-axis-1", 
        	    },
        	    {
        	    	 type: 'bar', 
        	        label: '今週の売り上げ個数',
        	        data: [mon2, tue2, wed2, thu2, fri2, sat2, sun2],
        	        borderColor : "rgba(54,164,235,0.8)",
        	        backgroundColor : "rgba(54,164,235,0.5)",
        	        yAxisID: "y-axis-2", 
        	    },
        	    ],
        	};
        
        //チャートメソッド呼び出し
    	myChart = new Chart(ctx, {
 
            data: barChartData,
            options: complexChartOption
    	});
    	
    }).fail(function(XMLHttpRequest, status, e){
      alert(e);
    });
});
