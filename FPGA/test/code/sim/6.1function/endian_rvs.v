module endian_rvs #
(
    parameter N = 4
)
(
    input          en,     //enable control
    input  [N-1:0] a ,
    output [N-1:0] b  
);

reg [N-1:0] b_temp;

always @(*) 
    begin
        if (en) 
            begin
                b_temp =  data_rvs(a);
            end
        else 
            begin
                b_temp = 0 ;
            end
    end

assign b = b_temp ;

defparam data_rvs.MASK = 32'd7 ;
//function entity
function [N-1:0] data_rvs ;
    parameter    MASK = 32'h3 ; //low 2bits are masked
    input [N-1:0] data_in;
    integer       k      ;
    begin
        for(k=0; k<N; k=k+1)
            begin
                data_rvs[N-k-1]  = data_in[k] ;
            end
    end
endfunction

endmodule
