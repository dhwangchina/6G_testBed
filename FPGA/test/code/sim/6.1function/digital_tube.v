module digital_tube
(
    input            clk          ,
    input            rstn         ,
    input            en           ,
    input      [3:0] single_digit ,
    input      [3:0] ten_digit    ,
    input      [3:0] hundred_digit,
    input      [3:0] kilo_digit   ,
    output reg [3:0] csn          , //chip select, low-available
    output reg [6:0] abcdefg        //light control
);

reg [1:0]            scan_r ;  //scan_ctrl
always @ (posedge clk or negedge rstn) 
    begin
        if(!rstn)
            begin
                csn     <= 4'b1111;
                abcdefg <= 'd0;
                scan_r  <= 3'd0;
            end
        else if (en) 
            begin
                case(scan_r)
                    2'd0:
                        begin
                            scan_r  <= 3'd1;
                            csn     <= 4'b0111;     //select single digit
                            abcdefg <= dt_translate(single_digit);
                        end
                    2'd1:
                        begin
                            scan_r  <= 3'd2;
                            csn     <= 4'b1011;     //select ten digit
                            abcdefg <= dt_translate(ten_digit);
                        end
                    2'd2:
                        begin
                            scan_r  <= 3'd3;
                            csn     <= 4'b1101;     //select hundred digit
                            abcdefg <= dt_translate(hundred_digit);
                        end
                    2'd3:
                        begin
                            scan_r  <= 3'd0;
                            csn     <= 4'b1110;     //select kilo digit
                            abcdefg <= dt_translate(kilo_digit);
                        end
                endcase
            end
    end

/*------------ translate function -------*/
function  [6:0] dt_translate;
    input [3:0] data;
    begin
        case(data)
            4'd0: dt_translate = 7'b1111110;     //number 0 -> 0x7e
            4'd1: dt_translate = 7'b0110000;     //number 1 -> 0x30
            4'd2: dt_translate = 7'b1101101;     //number 2 -> 0x6d
            4'd3: dt_translate = 7'b1111001;     //number 3 -> 0x79
            4'd4: dt_translate = 7'b0110011;     //number 4 -> 0x33
            4'd5: dt_translate = 7'b1011011;     //number 5 -> 0x5b
            4'd6: dt_translate = 7'b1011111;     //number 6 -> 0x5f
            4'd7: dt_translate = 7'b1110000;     //number 7 -> 0x70
            4'd8: dt_translate = 7'b1111111;     //number 8 -> 0x7f
            4'd9: dt_translate = 7'b1111011;     //number 9 -> 0x7b
        endcase
    end
endfunction
// abcdefg <--> 1111111
//      -a-
//     |   |
//     f   b
//     |   |
//      -g-
//     |   |
//     e   c
//     |   |
//      -d-

endmodule
