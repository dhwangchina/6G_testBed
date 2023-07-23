`timescale 1ns/1ns

module test ;

reg          en;
wire [4-1:0] b ;

initial
    #10 en = 1;
    
endian_rvs #
(
    4
) 
u_endian_rvs
(
    .en(en     ), 
    .a (4'b0011), 
    .b (b      )
);

//(2)constant function
parameter    MEM_DEPTH = 256;

reg  [logb2(MEM_DEPTH)-1: 0] addr = 0;

function integer logb2;
    input integer depth;
    begin
        for(logb2 = 0; depth > 1; logb2 = logb2 + 1) 
            begin
                depth = depth >> 1;
            end
    end
endfunction

//(3)automatic function
wire [31:0] results3 = factorial(4);

function automatic integer factorial;
    input integer data;
    integer       i   ;
    begin
        factorial = (data>=2)? data * factorial(data-1) : 1 ;
    end
endfunction // factorial

//no automatic
wire [31:0] results_noauto = factorial_no(4);

function integer factorial_no ;
    input integer data;
    integer       i   ;
    begin
        factorial_no = (data>=2)? data * factorial_no(data-1) : 1 ;
    end
endfunction // factorial

//(4)digital tube
reg        clk ;
reg        rstn ;
reg        dt_en ;
reg  [3:0] single_digit ;
reg  [3:0] ten_digit ;
reg  [3:0] hundred_digit ;
reg  [3:0] kilo_digit ;
wire [3:0] csn ;
wire [6:0] abcdefg ;

digital_tube u_digital_tube
(
    .clk           (clk           ),
    .rstn          (rstn          ),
    .en            (dt_en         ),
    .single_digit  (single_digit  ),
    .ten_digit     (ten_digit     ),
    .hundred_digit (hundred_digit ),
    .kilo_digit    (kilo_digit    ),
    .csn           (csn           ),
    .abcdefg       (abcdefg       ) 
);

always  
    begin
       clk = 0 ; # 5;
       clk = 1 ; # 5;
    end

initial 
    begin
        rstn              = 1'b0 ;
        dt_en             = 1'b0 ;
        single_digit      = 4'd1 ;
        ten_digit         = 4'd2 ;
        hundred_digit     = 4'd3 ;
        kilo_digit        = 4'd4 ;
        #5 rstn           = 1'b1 ;
        forever 
            begin
                dt_en          = 1'b1 ;
                repeat (5) @(negedge clk) ;
                single_digit   = single_digit + 4'd5 ;
                ten_digit      = ten_digit + 4'd5 ;
                hundred_digit  = hundred_digit + 4'd5 ;
                kilo_digit     = kilo_digit + 4'd5 ;
            end
    end


initial 
    begin
        forever 
            begin
                #100;
                if ($time >= 100000)  
                    $finish ;
            end
    end

endmodule // test
